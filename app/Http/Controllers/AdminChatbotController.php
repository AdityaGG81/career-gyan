<?php

namespace App\Http\Controllers;

use App\Models\AiChatLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminChatbotController extends Controller
{
    /**
     * Display a listing of chatbot queries with filters and KPIs.
     */
    public function index(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Safety check: ensure table exists or auto-run migration
        if (!\Illuminate\Support\Facades\Schema::hasTable('ai_chat_logs')) {
            try {
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            } catch (\Throwable $e) {}
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('ai_chat_logs')) {
            $logs = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
            $filters = [];
            $totalQueries = 0;
            $todayQueries = 0;
            $uniqueUsersCount = 0;
            $successCount = 0;
            $failedCount = 0;
            $rateLimitedCount = 0;
            $successRate = 100;
            $avgResponseTime = 0;

            return view('admin.chatbot.index', compact(
                'logs',
                'filters',
                'totalQueries',
                'todayQueries',
                'uniqueUsersCount',
                'successCount',
                'failedCount',
                'rateLimitedCount',
                'successRate',
                'avgResponseTime'
            ));
        }

        // Summary KPI Metrics
        $totalQueries = AiChatLog::count();
        $todayQueries = AiChatLog::whereDate('created_at', today())->count();
        $uniqueUsersCount = AiChatLog::distinct('user_id')->whereNotNull('user_id')->count('user_id');
        $successCount = AiChatLog::where('status', 'success')->count();
        $failedCount = AiChatLog::where('status', 'failed')->count();
        $rateLimitedCount = AiChatLog::where('status', 'rate_limited')->count();
        $successRate = $totalQueries > 0 ? round(($successCount / $totalQueries) * 100, 1) : 100;
        $avgResponseTime = (int) round((float) AiChatLog::whereNotNull('response_time_ms')->avg('response_time_ms'));

        // Query with filters and pagination
        $filters = $request->only(['q', 'status', 'date', 'user_id']);
        $logs = AiChatLog::filter($filters)
            ->with('user')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.chatbot.index', compact(
            'logs',
            'filters',
            'totalQueries',
            'todayQueries',
            'uniqueUsersCount',
            'successCount',
            'failedCount',
            'rateLimitedCount',
            'successRate',
            'avgResponseTime'
        ));
    }

    /**
     * Display or return details of a specific chatbot query.
     */
    public function show($id)
    {
        if (!session()->has('admin_logged_in')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('ai_chat_logs')) {
            return response()->json(['error' => 'Chatbot logs table is not available yet.'], 404);
        }

        $log = AiChatLog::with('user')->findOrFail($id);

        // Fetch conversation thread for the same session if available
        $sessionThread = [];
        if (!empty($log->session_id)) {
            $sessionThread = AiChatLog::where('session_id', $log->session_id)
                ->orderBy('created_at', 'asc')
                ->take(30)
                ->get();
        }

        return response()->json([
            'log' => $log,
            'session_thread' => $sessionThread,
            'formatted_date' => $log->created_at->format('d M, Y h:i:s A'),
            'relative_date' => $log->created_at->diffForHumans(),
        ]);
    }

    /**
     * Delete a specific log entry.
     */
    public function destroy($id)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $log = AiChatLog::findOrFail($id);
        $log->delete();

        return redirect()->back()->with('success', 'Chat question record deleted successfully.');
    }

    /**
     * Bulk clear chatbot logs.
     */
    public function clearLogs(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $range = $request->input('range', 'older_30');

        if ($range === 'all') {
            AiChatLog::truncate();
            $message = 'All chatbot logs have been cleared successfully.';
        } elseif ($range === 'older_30') {
            $count = AiChatLog::where('created_at', '<', now()->subDays(30))->delete();
            $message = "Cleared {$count} chatbot logs older than 30 days.";
        } elseif ($range === 'failed') {
            $count = AiChatLog::where('status', '!=', 'success')->delete();
            $message = "Cleared {$count} failed/rate-limited logs.";
        } else {
            return redirect()->back()->with('error', 'Invalid clear option selected.');
        }

        return redirect()->route('admin.chatbot.index')->with('success', $message);
    }

    /**
     * Export chatbot query logs as a CSV file.
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        if (!session()->has('admin_logged_in')) {
            abort(403);
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('ai_chat_logs')) {
            abort(404, 'Chatbot logs table is not available yet.');
        }

        $filters = $request->only(['q', 'status', 'date', 'user_id']);
        $query = AiChatLog::filter($filters)->with('user')->latest();

        $fileName = 'careergyan-chatbot-queries-' . now()->format('Y-m-d_H-i') . '.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($query) {
            $output = fopen('php://output', 'w');

            // BOM for UTF-8 Excel support
            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // CSV Header Row
            fputcsv($output, [
                'ID',
                'Date & Time',
                'User Name',
                'User Email',
                'Question',
                'AI Response',
                'Status',
                'Engine / Model',
                'Response Time (ms)',
                'IP Address',
                'Session ID',
            ]);

            // Stream chunked records to keep memory low
            $query->chunk(500, function ($logs) use ($output) {
                foreach ($logs as $log) {
                    fputcsv($output, [
                        $log->id,
                        $log->created_at->format('Y-m-d H:i:s'),
                        $log->user_name ?: ($log->user ? $log->user->name : 'Anonymous / Guest'),
                        $log->user_email ?: ($log->user ? $log->user->email : 'N/A'),
                        $log->question,
                        $log->reply,
                        $log->status,
                        $log->model_used ?: 'N/A',
                        $log->response_time_ms ?? 'N/A',
                        $log->ip_address ?? 'N/A',
                        $log->session_id ?? 'N/A',
                    ]);
                }
            });

            fclose($output);
        }, 200, $headers);
    }
}

