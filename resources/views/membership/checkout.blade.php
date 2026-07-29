@extends('layouts.app')

@section('title', 'Secure Checkout | CareerGyan')

@section('styles')
<style>
    .checkout-page {
        background: #f8fafc;
        min-height: calc(100vh - 100px);
        padding: 80px 24px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .checkout-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        max-width: 500px;
        width: 100%;
        padding: 40px;
        box-shadow: var(--shadow-lg);
        position: relative;
    }

    .checkout-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .checkout-header h2 {
        font-family: 'Sora';
        font-size: 24px;
        color: var(--text-1);
        font-weight: 800;
        margin-bottom: 8px;
    }

    .checkout-header p {
        font-size: 14px;
        color: var(--text-2);
    }

    .order-summary {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 20px;
        margin-bottom: 30px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 14.5px;
        color: var(--text-2);
    }

    .summary-row:last-child {
        margin-bottom: 0;
        border-top: 1px solid var(--border);
        padding-top: 12px;
        font-weight: 700;
        color: var(--text-1);
    }

    .simulation-banner {
        background: #fffbeb;
        border: 1px solid #fef3c7;
        color: #b45309;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 25px;
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .checkout-actions {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .pay-btn {
        width: 100%;
        height: 52px;
        background: var(--brand);
        color: white;
        border-radius: var(--radius-md);
        font-weight: 700;
        font-size: 15.5px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s;
    }

    .pay-btn:hover {
        background: var(--brand-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .pay-btn-simulate-fail {
        background: #ef4444;
    }
    .pay-btn-simulate-fail:hover {
        background: #dc2626;
    }

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.85);
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-xl);
        z-index: 50;
    }

    .spinner {
        border: 4px solid rgba(0,0,0,0.1);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border-left-color: var(--brand);
        animation: spin 1s linear infinite;
        margin-bottom: 15px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection

@section('content')
<div class="checkout-page">
    <div class="checkout-card">
        
        <!-- Loading overlay -->
        <div class="loading-overlay" id="loadingOverlay">
            <div class="spinner"></div>
            <div style="font-weight: 700; color: var(--text-1); font-size: 15px;">Verifying Payment...</div>
            <div style="font-size: 13px; color: var(--text-2); margin-top: 4px;">Please do not refresh or close the page</div>
        </div>

        <div class="checkout-header">
            <h2>Secure Checkout</h2>
            <p>Complete your payment details to activate Pro</p>
        </div>

        <div class="order-summary">
            <div class="summary-row">
                <span>Plan Duration</span>
                <span>{{ $plan->duration_days }} Days (1 Year)</span>
            </div>
            <div class="summary-row">
                <span>Access Scope</span>
                <span>Unlimited Assessment Suite</span>
            </div>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>₹{{ number_format($plan->price / 100, 2) }}</span>
            </div>
            <div class="summary-row">
                <span>Total Amount Due</span>
                <span style="color: var(--brand); font-size: 18px;">₹{{ number_format($plan->price / 100, 2) }}</span>
            </div>
        </div>

        @if($isSimulation)
            <div class="simulation-banner">
                <div>⚠️ Sandbox Simulation Mode Active</div>
                <div style="font-size: 12px; font-weight: 400; color: #78350f;">
                    Razorpay credentials are not configured in your environment yet. You can simulate the checkout process below.
                </div>
            </div>

            <div class="checkout-actions">
                <button onclick="handleSimulation(true)" class="pay-btn">
                    <i class="fa-solid fa-circle-check"></i> Simulate Successful Payment
                </button>
                <button onclick="handleSimulation(false)" class="pay-btn pay-btn-simulate-fail">
                    <i class="fa-solid fa-circle-xmark"></i> Simulate Failed Payment
                </button>
            </div>
        @else
            <div class="checkout-actions">
                <button id="payWithRazorpay" class="pay-btn">
                    <i class="fa-solid fa-credit-card"></i> Pay Now with Razorpay
                </button>
            </div>
        @endif

        <div style="text-align: center; margin-top: 30px; font-size: 12px; color: var(--text-3);">
            <i class="fa-solid fa-lock" style="margin-right: 4px;"></i> Secure SSL connection • Powered by Razorpay
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if(!$isSimulation)
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('payWithRazorpay').onclick = function(e) {
            const options = {
                "key": "{{ $keyId }}",
                "amount": "{{ $plan->price }}",
                "currency": "INR",
                "name": "CareerGyan",
                "description": "Pro Member Subscription",
                "image": "{{ asset('images/logo.png') }}",
                "order_id": "{{ $orderId }}",
                "handler": function (response){
                    verifyPayment(response.razorpay_payment_id, response.razorpay_order_id, response.razorpay_signature, false);
                },
                "prefill": {
                    "name": "{{ Auth::user()->name }}",
                    "email": "{{ Auth::user()->email }}",
                    "contact": "{{ Auth::user()->phone ?? '' }}"
                },
                "theme": {
                    "color": "#1a56db"
                }
            };
            const rzp = new Razorpay(options);
            rzp.on('payment.failed', function (response){
                alert("Payment Failed: " + response.error.description);
            });
            rzp.open();
            e.preventDefault();
        }
    </script>
@endif

<script>
    function handleSimulation(success) {
        if (!success) {
            alert("Payment failed: Simulated cancellation by user.");
            return;
        }

        const mockPaymentId = 'pay_mock_' + Math.random().toString(36).substr(2, 9);
        const mockOrderId = '{{ $orderId }}' || 'order_mock_' + Math.random().toString(36).substr(2, 9);
        const mockSignature = 'sig_mock_' + Math.random().toString(36).substr(2, 9);

        verifyPayment(mockPaymentId, mockOrderId, mockSignature, true);
    }

    function verifyPayment(paymentId, orderId, signature, isSimulation) {
        document.getElementById('loadingOverlay').style.display = 'flex';

        fetch("{{ route('membership.verify') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                razorpay_payment_id: paymentId,
                razorpay_order_id: orderId,
                razorpay_signature: signature,
                is_simulation: isSimulation
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('membership.success') }}";
            } else {
                document.getElementById('loadingOverlay').style.display = 'none';
                alert(data.message || "Payment verification failed.");
            }
        })
        .catch(error => {
            document.getElementById('loadingOverlay').style.display = 'none';
            console.error('Error:', error);
            alert("An error occurred during payment verification. Please try again.");
        });
    }
</script>
@endsection
