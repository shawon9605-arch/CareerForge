<?php /** @var bool|null $registered */ ?>
<link rel="stylesheet" href="{{ asset('assets/style.css') }}">

<div class="auth-container">

    <div class="auth-left">
        <h1>CareerForge</h1>
        <p>Create your account and start building your career 💼</p>
    </div>

    <div class="auth-right">
        <div class="auth-card">
            <h2>Register</h2>

            <form method="POST" action="{{ route('student.register.submit') }}">
                @csrf
                <input type="text" name="name" placeholder="👤 Full Name" required>
                <input type="email" name="email" placeholder="📧 Email" required>
                <input type="password" name="password" placeholder="🔒 Password" required>
                <button name="register">Create Account</button>
            </form>

            <p class="switch">
                Already have an account? <a href="{{ route('student.login') }}">Login</a>
            </p>
        </div>
    </div>

</div>

@if(!empty($registered))
    <p style='color:lightgreen;text-align:center;'>Registered Successfully!</p>
@endif
