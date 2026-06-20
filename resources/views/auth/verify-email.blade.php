<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - CareerGyan</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#2563eb,#1e3a8a);
            padding:20px;
        }

        .card{
            width:100%;
            max-width:500px;
            background:#fff;
            border-radius:24px;
            padding:40px;
            box-shadow:0 20px 50px rgba(0,0,0,0.15);
            text-align:center;
        }

        .logo{
            width:80px;
            height:80px;
            margin:0 auto 20px;
            border-radius:50%;
            background:#eff6ff;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:38px;
        }

        h1{
            color:#111827;
            margin-bottom:10px;
            font-size:30px;
        }

        .subtitle{
            color:#6b7280;
            margin-bottom:30px;
            line-height:1.6;
            font-size:15px;
        }

        .alert{
            padding:14px;
            border-radius:10px;
            margin-bottom:20px;
            font-size:14px;
        }

        .success{
            background:#dcfce7;
            color:#166534;
        }

        .error{
            background:#fee2e2;
            color:#991b1b;
        }

        .otp-input{
            width:100%;
            height:60px;
            border:2px solid #d1d5db;
            border-radius:14px;
            font-size:26px;
            text-align:center;
            letter-spacing:10px;
            margin-bottom:20px;
            transition:.3s;
        }

        .otp-input:focus{
            outline:none;
            border-color:#2563eb;
            box-shadow:0 0 0 4px rgba(37,99,235,.15);
        }

        .verify-btn{
            width:100%;
            height:55px;
            border:none;
            border-radius:14px;
            background:#2563eb;
            color:white;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        .verify-btn:hover{
            background:#1d4ed8;
        }

        .divider{
            margin:25px 0;
            border-top:1px solid #e5e7eb;
        }

        .resend-btn{
            background:none;
            border:none;
            color:#2563eb;
            font-weight:600;
            cursor:pointer;
            font-size:15px;
        }

        .resend-btn:hover{
            text-decoration:underline;
        }

        .resend-btn:disabled{
            color:#9ca3af;
            cursor:not-allowed;
            text-decoration:none;
        }

        .countdown{
            margin-top:12px;
            color:#6b7280;
            font-size:14px;
        }

        .footer{
            margin-top:25px;
            color:#9ca3af;
            font-size:13px;
        }

        @media(max-width:600px){

            .card{
                padding:30px 25px;
            }

            .otp-input{
                font-size:22px;
                letter-spacing:6px;
            }

            h1{
                font-size:24px;
            }
        }

    </style>
</head>
<body>

<div class="card">

    <div class="logo">
        📧
    </div>

    <h1>Email Verification</h1>

    <p class="subtitle">
        We've sent a 6-digit verification code to your email address.
        Enter the code below to activate your CareerGyan account.
    </p>

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verify.email.submit') }}">
        @csrf

        <input
            type="text"
            name="otp"
            maxlength="6"
            class="otp-input"
            placeholder="000000"
            required
            autofocus
        >

        <button type="submit" class="verify-btn">
            Verify Email
        </button>
    </form>

    <div class="divider"></div>

    <form method="POST" action="{{ route('resend.email.otp') }}">
        @csrf

        <button
            type="submit"
            id="resendBtn"
            class="resend-btn"
            disabled>
            🔄 Resend OTP
        </button>
    </form>

    <div id="countdown" class="countdown">
        Resend available in 60 seconds
    </div>

    <div class="footer">
        CareerGyan Secure Verification System
    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function(){

    let seconds = 60;

    const resendBtn = document.getElementById('resendBtn');
    const countdown = document.getElementById('countdown');

    if(!resendBtn || !countdown){
        return;
    }

    resendBtn.disabled = true;

    const timer = setInterval(function(){

        seconds--;

        countdown.textContent =
            "Resend available in " + seconds + " seconds";

        if(seconds <= 0){

            clearInterval(timer);

            resendBtn.disabled = false;

            countdown.textContent =
                "You can request a new OTP now";
        }

    }, 1000);

});
</script>

</body>
</html>