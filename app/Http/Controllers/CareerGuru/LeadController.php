<?php

namespace App\Http\Controllers\CareerGuru;

use App\Http\Controllers\Controller;
use App\Models\CareerGuru;
use App\Models\CareerGuruLead;
use App\Models\CareerGuruCommission;
use App\Models\User;
use App\Services\CareerGuruService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    protected function guru(): CareerGuru
    {
        return Auth::guard('careerguru')->user();
    }

    /**
     * List all student leads for current CareerGuru.
     */
    public function index(Request $request)
    {
        $guru = $this->guru();

        $search = trim($request->query('search', ''));
        $standard = $request->query('standard', '');
        $status = $request->query('status', '');
        $registrationStatus = $request->query('registration_status', $request->query('reg_status', ''));
        $premiumStatus = $request->query('premium_status', '');
        $dateFilter = $request->query('date_filter', '');

        $query = $guru->leads()->with(['registeredUser'])->latest();

        // Search
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('school_college', 'like', "%{$search}%");
            });
        }

        // Filter by standard
        if ($standard !== '' && $standard !== 'all') {
            $query->where('standard', $standard);
        }

        // Filter by lead status
        if ($status !== '' && $status !== 'all') {
            $query->where('lead_status', $status);
        }

        // Filter by registration status
        if ($registrationStatus !== '' && $registrationStatus !== 'all') {
            if ($registrationStatus === 'registered') {
                $query->where(function ($q) {
                    $q->whereNotNull('registered_user_id')
                      ->orWhere('lead_status', 'Registered on CareerGyan')
                      ->orWhere('lead_status', 'Premium Purchased');
                });
            } elseif ($registrationStatus === 'not_registered') {
                $query->whereNull('registered_user_id')
                      ->where('lead_status', '!=', 'Registered on CareerGyan')
                      ->where('lead_status', '!=', 'Premium Purchased');
            }
        }

        // Filter by premium status
        if ($premiumStatus !== '' && $premiumStatus !== 'all') {
            if ($premiumStatus === 'premium') {
                $query->where(function ($q) {
                    $q->where('lead_status', 'Premium Purchased')
                      ->orWhereNotNull('premium_purchased_at');
                });
            } elseif ($premiumStatus === 'free') {
                $query->where('lead_status', '!=', 'Premium Purchased')
                      ->whereNull('premium_purchased_at');
            }
        }

        // Filter by date added
        if ($dateFilter === 'today') {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($dateFilter === 'this_week') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($dateFilter === 'this_month') {
            $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
        } elseif ($dateFilter === 'last_month') {
            $query->whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()]);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $leads = $query->paginate(15)->withQueryString();

        $standards = CareerGuruLead::STANDARDS;
        $statuses = CareerGuruLead::STATUSES;

        return view('careerguru.students.index', compact(
            'guru',
            'leads',
            'standards',
            'statuses',
            'search',
            'standard',
            'status',
            'registrationStatus',
            'premiumStatus',
            'dateFilter'
        ));
    }

    /**
     * Show form to add a student lead.
     */
    public function create()
    {
        $guru = $this->guru();
        $standards = CareerGuruLead::STANDARDS;
        $statuses = CareerGuruLead::STATUSES;

        return view('careerguru.students.create', compact('guru', 'standards', 'statuses'));
    }

    /**
     * Store newly created student lead.
     */
    public function store(Request $request, CareerGuruService $service)
    {
        $guru = $this->guru();

        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'standard' => ['required', 'string'],
            'additional_notes' => ['required', 'string', 'max:5000'],
            // Optional
            'parent_name' => ['nullable', 'string', 'max:255'],
            'parent_phone' => ['nullable', 'string', 'max:20'],
            'city' => ['nullable', 'string', 'max:100'],
            'school_college' => ['nullable', 'string', 'max:255'],
            'interested_course' => ['nullable', 'string', 'max:255'],
            'lead_status' => ['nullable', 'string'],
            'next_followup_at' => ['nullable', 'date'],
        ]);

        $email = strtolower(trim($validated['email']));
        $phone = preg_replace('/[^0-9]/', '', $validated['phone']);

        // Check if this CareerGuru already added this lead
        $existing = CareerGuruLead::where('careerguru_id', $guru->id)
            ->where(function ($q) use ($email, $phone) {
                $q->where('email', $email);
                if (!empty($phone)) {
                    $q->orWhere('phone', $phone);
                }
            })->first();

        if ($existing) {
            return redirect()->route('careerguru.students.show', $existing->id)
                ->with('warning', 'A student lead with this email or phone number already exists in your account.');
        }

        // Check if student is already registered on CareerGyan
        $registeredUser = User::where('email', $email)
            ->orWhere(function ($q) use ($phone) {
                if (!empty($phone)) {
                    $q->where('phone', $phone);
                }
            })->first();

        $leadStatus = $validated['lead_status'] ?? 'New Lead';
        $registeredUserId = null;
        $registeredAt = null;
        $premiumPurchasedAt = null;

        if ($registeredUser) {
            $registeredUserId = $registeredUser->id;
            $registeredAt = $registeredUser->created_at;

            // Associate user to guru if not attributed
            if (!$registeredUser->careerguru_id) {
                $registeredUser->careerguru_id = $guru->id;
                $registeredUser->careerguru_registered_at = $registeredUser->careerguru_registered_at ?? now();
                $registeredUser->save();
            }

            if ($registeredUser->hasActiveMembership()) {
                $leadStatus = 'Premium Purchased';
                $premiumPurchasedAt = $registeredUser->memberships()->where('status', 'active')->latest()->value('created_at') ?? now();
            } else {
                $leadStatus = 'Registered on CareerGyan';
            }
        }

        $lead = CareerGuruLead::create([
            'careerguru_id' => $guru->id,
            'student_name' => trim($validated['student_name']),
            'phone' => trim($validated['phone']),
            'email' => $email,
            'standard' => $validated['standard'],
            'parent_name' => $validated['parent_name'] ?? null,
            'parent_phone' => $validated['parent_phone'] ?? null,
            'city' => $validated['city'] ?? null,
            'school_college' => $validated['school_college'] ?? null,
            'interested_course' => $validated['interested_course'] ?? null,
            'lead_status' => $leadStatus,
            'registered_user_id' => $registeredUserId,
            'registered_at' => $registeredAt,
            'premium_purchased_at' => $premiumPurchasedAt,
            'additional_notes' => trim($validated['additional_notes']),
            'next_followup_at' => $validated['next_followup_at'] ?? null,
        ]);

        // Log initial activity
        $service->recordLeadActivity(
            $lead->id,
            $guru->id,
            'lead_created',
            'New Student Lead Added',
            "Lead created for {$lead->student_name} ({$lead->standard}). Initial notes: " . Str::limit($lead->additional_notes, 100)
        );

        if ($registeredUser) {
            $service->recordLeadActivity(
                $lead->id,
                $guru->id,
                'student_registered',
                'Matched Existing CareerGyan User',
                "Student is already registered on CareerGyan as User #{$registeredUser->id}."
            );
        }

        return redirect()->route('careerguru.students.show', $lead->id)
            ->with('success', "Student lead for '{$lead->student_name}' added successfully!");
    }

    /**
     * View complete student information & timeline.
     */
    public function show($id)
    {
        $guru = $this->guru();
        $lead = $guru->leads()->with(['registeredUser.memberships', 'activities', 'commissions'])->findOrFail($id);
        $statuses = CareerGuruLead::STATUSES;

        // Custom referral link for this student
        $studentReferralUrl = route('signup', [
            'guru' => $guru->referral_code,
            'email' => $lead->email,
            'name' => $lead->student_name,
        ]);

        return view('careerguru.students.show', compact('guru', 'lead', 'statuses', 'studentReferralUrl'));
    }

    /**
     * Show edit student form.
     */
    public function edit($id)
    {
        $guru = $this->guru();
        $lead = $guru->leads()->findOrFail($id);
        $standards = CareerGuruLead::STANDARDS;
        $statuses = CareerGuruLead::STATUSES;

        return view('careerguru.students.edit', compact('guru', 'lead', 'standards', 'statuses'));
    }

    /**
     * Update student lead information.
     */
    public function update(Request $request, $id, CareerGuruService $service)
    {
        $guru = $this->guru();
        $lead = $guru->leads()->findOrFail($id);

        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'standard' => ['required', 'string'],
            'parent_name' => ['nullable', 'string', 'max:255'],
            'parent_phone' => ['nullable', 'string', 'max:20'],
            'city' => ['nullable', 'string', 'max:100'],
            'school_college' => ['nullable', 'string', 'max:255'],
            'interested_course' => ['nullable', 'string', 'max:255'],
            'additional_notes' => ['nullable', 'string', 'max:5000'],
            'next_followup_at' => ['nullable', 'date'],
        ]);

        $lead->update($validated);

        $service->recordLeadActivity(
            $lead->id,
            $guru->id,
            'status_change',
            'Lead Information Updated',
            "Profile and contact details updated by {$guru->name}."
        );

        return redirect()->route('careerguru.students.show', $lead->id)
            ->with('success', 'Student details updated successfully.');
    }

    /**
     * Update lead communication status.
     */
    public function updateStatus(Request $request, $id, CareerGuruService $service)
    {
        $guru = $this->guru();
        $lead = $guru->leads()->findOrFail($id);

        $request->validate([
            'lead_status' => ['required', 'string', 'in:New Lead,Contacted,Interested,Follow-up Required,Not Interested'],
            'remarks' => ['nullable', 'string', 'max:500'],
        ]);

        $oldStatus = $lead->lead_status;
        $newStatus = $request->lead_status;

        // Prevent downgrading if already registered or premium
        if ($lead->isRegistered() && !in_array($newStatus, ['Follow-up Required', 'Interested', 'Contacted'])) {
            // Keep registered status flag intact
        } else {
            $lead->lead_status = $newStatus;
        }

        $lead->save();

        $desc = "Status changed from '{$oldStatus}' to '{$newStatus}'.";
        if ($request->filled('remarks')) {
            $desc .= " Remarks: " . $request->remarks;
        }

        $service->recordLeadActivity($lead->id, $guru->id, 'status_change', "Lead Status: {$newStatus}", $desc);

        return back()->with('success', "Status updated to '{$newStatus}'.");
    }

    /**
     * Append a timestamped note / remark.
     */
    public function addNote(Request $request, $id, CareerGuruService $service)
    {
        $guru = $this->guru();
        $lead = $guru->leads()->findOrFail($id);

        $request->validate([
            'note' => ['required', 'string', 'max:3000'],
            'next_followup_at' => ['nullable', 'date'],
        ]);

        $timestamp = now()->format('d M Y, h:i A');
        $newEntry = "\n\n[" . $timestamp . " by " . $guru->name . "]: " . trim($request->note);

        $lead->additional_notes = ($lead->additional_notes ? $lead->additional_notes : '') . $newEntry;

        if ($request->filled('next_followup_at')) {
            $lead->next_followup_at = $request->next_followup_at;
        }

        $lead->save();

        $service->recordLeadActivity(
            $lead->id,
            $guru->id,
            'note_added',
            'Follow-up Note Added',
            trim($request->note) . ($request->filled('next_followup_at') ? " (Next Follow-up: {$request->next_followup_at})" : '')
        );

        return back()->with('success', 'Follow-up note appended to student file.');
    }

    /**
     * Dedicated Registered Students Section.
     */
    public function registeredStudents(Request $request)
    {
        $guru = $this->guru();

        $query = $guru->registeredStudents()
            ->with(['memberships' => fn($q) => $q->latest()])
            ->latest('careerguru_registered_at');

        if ($request->filled('search')) {
            $s = trim($request->search);
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%");
            });
        }

        if ($request->filled('membership')) {
            if ($request->membership === 'pro') {
                $query->where('is_member', true);
            } elseif ($request->membership === 'free') {
                $query->where('is_member', false);
            }
        }

        $students = $query->paginate(15)->withQueryString();

        return view('careerguru.students.registered', compact('guru', 'students'));
    }

    /**
     * Dedicated Separate Premium Purchased Students Table.
     */
    public function premiumStudents(Request $request)
    {
        $guru = $this->guru();

        $query = $guru->commissions()
            ->with(['studentUser', 'lead', 'membership'])
            ->latest();

        if ($request->filled('search')) {
            $s = trim($request->search);
            $query->whereHas('studentUser', function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $commissions = $query->paginate(15)->withQueryString();

        return view('careerguru.students.premium', compact('guru', 'commissions'));
    }

    /**
     * Commission History view.
     */
    public function commissions(Request $request)
    {
        $guru = $this->guru();

        $query = $guru->commissions()
            ->with(['studentUser', 'membership'])
            ->latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $commissions = $query->paginate(15)->withQueryString();

        $totalEarned = $guru->totalCommissionEarned();
        $pendingCommission = $guru->pendingCommission();
        $approvedCommission = $guru->approvedCommission();
        $paidCommission = $guru->paidCommission();

        return view('careerguru.commissions.index', compact(
            'guru',
            'commissions',
            'totalEarned',
            'pendingCommission',
            'approvedCommission',
            'paidCommission'
        ));
    }
}

