<?php /** @var string|null $error */ ?>
<link rel="stylesheet" href="{{ asset('assets/style.css') }}">

<div class="auth-container">

    <div class="auth-left">
        <h1>CareerForge</h1>
        <p>Welcome back! Continue your journey to success 🚀</p>
    </div>

    <div class="auth-right">
        <div class="auth-card">
            <h2>Login</h2>

            @if(!empty($error))
                <p style="color:red;text-align:center;">{{ $error }}</p>
            @endif

            <form method="POST" action="{{ route('student.login.submit') }}">
                @csrf
                <input type="email" name="email" placeholder="📧 Email" required>
                <input type="password" name="password" placeholder="🔒 Password" required>
                <button name="login">Login</button>
            </form>

            <p class="switch">
                Don't have an account? <a href="{{ route('student.register') }}">Register</a>
            </p>
        </div>
    </div>

</div>
