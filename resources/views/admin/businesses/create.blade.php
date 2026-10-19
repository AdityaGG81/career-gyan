@extends('admin.layout')

@section('title', 'Add Business Opportunity')
@section('page_title', 'Create Business Opportunity')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.businesses.index') }}" style="color: var(--admin-text-2); text-decoration: none; font-size: 14px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px;">
        <i class="fa-solid fa-arrow-left"></i> Back to Business Corner Directory
    </a>
</div>

<div class="panel-card" style="max-width: 920px;">
    <div class="panel-header">
        <h2>New Business Opportunity Form</h2>
        <span style="font-size: 12px; color: var(--admin-text-3);">All fields marked with <strong style="color: #ef4444;">*</strong> are required</span>
    </div>

    <div style="padding: 32px;">
        @if (isset($errors) && $errors->any())
            <div class="admin-alert admin-alert-error" style="margin-bottom: 24px;">
                <i class="fa-solid fa-circle-exclamation"></i>
                <ul style="margin-left: 20px; padding: 0; list-style-type: disc;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.businesses.store') }}" method="POST">
            @csrf

            <!-- Section 1: Basic Business Overview -->
            <div style="margin-bottom: 28px;">
                <h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid var(--admin-border); padding-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-building" style="color: #2563eb;"></i> 1. Basic Information
                </h3>

                <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                            Business Name <strong style="color: #ef4444;">*</strong>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="form-control" placeholder="e.g. Mini Supermarket & Kirana Store, Web Dev Agency">
                    </div>

                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                            Category <strong style="color: #ef4444;">*</strong>
                        </label>
                        <select name="category_select" id="category_select" required class="form-control" style="background: #ffffff;" onchange="toggleCustomCategory()">
                            <option value="">Select Business Category</option>
                            @foreach($standardCategories as $cat)
                                <option value="{{ $cat }}" {{ old('category_select') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                            <option value="Other" {{ old('category_select') == 'Other' ? 'selected' : '' }}>Other (Custom Category)</option>
                        </select>

                        <div id="category_custom_div" style="margin-top: 10px; display: {{ old('category_select') == 'Other' ? 'block' : 'none' }};">
                            <input type="text" name="category_custom" id="category_custom" value="{{ old('category_custom') }}" class="form-control" placeholder="Enter custom category name">
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                        Business Model Description <strong style="color: #ef4444;">*</strong>
                    </label>
                    <textarea name="description" rows="3" required class="form-control" placeholder="Explain the core business idea, how it generates revenue, and what makes it attractive...">{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- Section 2: Financials & Investment -->
            <div style="margin-bottom: 28px;">
                <h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid var(--admin-border); padding-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-indian-rupee-sign" style="color: #16a34a;"></i> 2. Financials & Feasibility
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                            Initial Investment Required <strong style="color: #ef4444;">*</strong>
                        </label>
                        <input type="text" name="initial_investment" value="{{ old('initial_investment') }}" required class="form-control" placeholder="e.g. ₹50,000 - ₹1.5 Lakhs">
                    </div>

                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                            Estimated Profit Margin
                        </label>
                        <input type="text" name="profit_margin" value="{{ old('profit_margin', '20% - 35%') }}" class="form-control" placeholder="e.g. 25% - 40%">
                    </div>

                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                            Risk Level <strong style="color: #ef4444;">*</strong>
                        </label>
                        <select name="risk_level" required class="form-control" style="background: #ffffff;">
                            <option value="Low" {{ old('risk_level', 'Low') == 'Low' ? 'selected' : '' }}>Low Risk</option>
                            <option value="Medium" {{ old('risk_level') == 'Medium' ? 'selected' : '' }}>Medium Risk</option>
                            <option value="High" {{ old('risk_level') == 'High' ? 'selected' : '' }}>High Risk</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                            Expected Break-Even / ROI Period
                        </label>
                        <input type="text" name="break_even_period" value="{{ old('break_even_period', '3 - 6 Months') }}" class="form-control" placeholder="e.g. 3 - 6 Months, 6 - 9 Months">
                    </div>

                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                            Time to Launch
                        </label>
                        <input type="text" name="start_time" value="{{ old('start_time', '2-4 Weeks') }}" class="form-control" placeholder="e.g. 1-2 Weeks, 3-4 Weeks">
                    </div>
                </div>
            </div>

            <!-- Section 3: Skills Blueprint -->
            <div style="margin-bottom: 28px;">
                <h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid var(--admin-border); padding-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-graduation-cap" style="color: #8b5cf6;"></i> 3. Skills Required (Hard & Soft Skills)
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 4px;">
                            Hard & Domain Skills Required <strong style="color: #ef4444;">*</strong>
                        </label>
                        <span style="font-size: 12px; color: var(--admin-text-3); display: block; margin-bottom: 8px;">
                            Separate skills with commas (e.g. Inventory management, POS billing, Vendor sourcing)
                        </span>
                        <textarea name="skills_required" rows="4" required class="form-control" placeholder="Inventory tracking, Soldering, Web coding, Basic GST accounting...">{{ old('skills_required') }}</textarea>
                    </div>

                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 4px;">
                            Soft Skills Required <strong style="color: #ef4444;">*</strong>
                        </label>
                        <span style="font-size: 12px; color: var(--admin-text-3); display: block; margin-bottom: 8px;">
                            Separate skills with commas (e.g. Customer relationship, Negotiation, Empathy, Active listening)
                        </span>
                        <textarea name="soft_skills" rows="4" required class="form-control" placeholder="Customer communication, Negotiation, Conflict handling, Leadership, Resilience...">{{ old('soft_skills') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 4: Market Opportunities & Operations -->
            <div style="margin-bottom: 28px;">
                <h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid var(--admin-border); padding-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-chart-line" style="color: #f59e0b;"></i> 4. Market Opportunities & Operations
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 4px;">
                            Possible Business Opportunities & Growth Areas
                        </label>
                        <span style="font-size: 12px; color: var(--admin-text-3); display: block; margin-bottom: 8px;">
                            Expansion routes, e.g. WhatsApp home delivery, B2B wholesale tie-ups, Franchise model
                        </span>
                        <textarea name="opportunities" rows="3" class="form-control" placeholder="Institutional supply, WhatsApp delivery orders, Monthly subscription packages...">{{ old('opportunities') }}</textarea>
                    </div>

                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 4px;">
                            Key Equipment & Tools Needed
                        </label>
                        <span style="font-size: 12px; color: var(--admin-text-3); display: block; margin-bottom: 8px;">
                            Machinery, computing, displays, or tools needed to start
                        </span>
                        <textarea name="equipment_needed" rows="3" class="form-control" placeholder="Display racks, Billing machine, Weighing scale, Smartphone/Laptop...">{{ old('equipment_needed') }}</textarea>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                            Target Audience / Client Profile
                        </label>
                        <input type="text" name="target_audience" value="{{ old('target_audience') }}" class="form-control" placeholder="e.g. Residential families, Students, SMEs">
                    </div>

                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                            FontAwesome Icon
                        </label>
                        <input type="text" name="icon" value="{{ old('icon', 'fa-store') }}" class="form-control" placeholder="e.g. fa-store, fa-laptop-code, fa-mobile-screen">
                    </div>

                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: var(--admin-text-2); display: block; margin-bottom: 8px;">
                            Listing Status <strong style="color: #ef4444;">*</strong>
                        </label>
                        <select name="status" required class="form-control" style="background: #ffffff;">
                            <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active (Visible to users)</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive (Draft)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Submit Button Bar -->
            <div style="display: flex; gap: 12px; justify-content: flex-end; padding-top: 20px; border-top: 1px solid var(--admin-border);">
                <a href="{{ route('admin.businesses.index') }}" style="padding: 11px 22px; border-radius: var(--admin-radius-md); border: 1px solid var(--admin-border); color: var(--admin-text-2); background: #ffffff; text-decoration: none; font-weight: 600; font-size: 13.5px;">
                    Cancel
                </a>
                <button type="submit" style="padding: 11px 28px; border-radius: var(--admin-radius-md); background: #2563eb; color: #ffffff; border: none; font-weight: 600; font-size: 13.5px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);">
                    <i class="fa-solid fa-check"></i> Publish Business Opportunity
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleCustomCategory() {
        const select = document.getElementById('category_select');
        const customDiv = document.getElementById('category_custom_div');
        const customInput = document.getElementById('category_custom');

        if (select.value === 'Other') {
            customDiv.style.display = 'block';
            customInput.setAttribute('required', 'required');
            customInput.focus();
        } else {
            customDiv.style.display = 'none';
            customInput.removeAttribute('required');
        }
    }
</script>
@endsection
