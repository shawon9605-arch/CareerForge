<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        CareerForge Login
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        * {

            margin: 0;
            padding: 0;

            box-sizing: border-box;

            font-family: 'Poppins', sans-serif;

        }

        body {

            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            background:
            linear-gradient(
                135deg,
                #0f172a,
                #1e1b4b,
                #312e81
            );

            overflow: hidden;

            position: relative;

        }

        /* GLOW EFFECT */

        .glow {

            position: absolute;

            width: 450px;
            height: 450px;

            border-radius: 50%;

            background:
            rgba(124,58,237,0.25);

            filter: blur(120px);

        }

        .glow.one {

            top: -100px;
            left: -100px;

        }

        .glow.two {

            bottom: -100px;
            right: -100px;

        }

        /* CONTAINER */

        .auth-container {

            width: 950px;
            height: 600px;

            display: flex;

            border-radius: 35px;

            overflow: hidden;

            background:
            rgba(255,255,255,0.08);

            border:
            1px solid rgba(255,255,255,0.1);

            backdrop-filter: blur(15px);

            box-shadow:
            0 25px 50px rgba(0,0,0,0.35);

            position: relative;

            z-index: 10;

        }

        /* LEFT */

        .left {

            flex: 1;

            padding: 70px;

            display: flex;
            flex-direction: column;
            justify-content: center;

            color: white;

        }

        .logo {

            font-size: 40px;
            font-weight: 700;

            margin-bottom: 25px;

        }

        .left h1 {

            font-size: 50px;

            line-height: 1.2;

            margin-bottom: 20px;

        }

        .left p {

            color:
            rgba(255,255,255,0.75);

            line-height: 1.8;

            font-size: 16px;

        }

        /* RIGHT */

        .right {

            flex: 1;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 50px;

            background:
            rgba(255,255,255,0.04);

        }

        .auth-card {

            width: 100%;

        }

        .auth-card h2 {

            color: white;

            font-size: 38px;

            margin-bottom: 30px;

        }

        .input-group {

            margin-bottom: 22px;

        }

        .input-group label {

            display: block;

            color:
            rgba(255,255,255,0.75);

            margin-bottom: 10px;

        }

        .input-group input {

            width: 100%;

            padding: 16px;

            border-radius: 16px;

            border:
            1px solid rgba(255,255,255,0.08);

            background:
            rgba(255,255,255,0.06);

            color: white;

            outline: none;

            transition: 0.3s;

        }

        .input-group input:focus {

            border-color: #7c3aed;

            box-shadow:
            0 0 0 4px rgba(124,58,237,0.2);

        }

        .input-group input::placeholder {

            color:
            rgba(255,255,255,0.45);

        }

        /* BUTTON */

        .btn {

            width: 100%;

            padding: 16px;

            border: none;

            border-radius: 18px;

            background:
            linear-gradient(
                90deg,
                #4f46e5,
                #7c3aed
            );

            color: white;

            font-size: 16px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.3s;

        }

        .btn:hover {

            transform: translateY(-2px);

            box-shadow:
            0 15px 30px rgba(124,58,237,0.35);

        }

        /* SWITCH */

        .switch {

            margin-top: 25px;

            text-align: center;

            color:
            rgba(255,255,255,0.7);

        }

        .switch a {

            color: #a78bfa;

            text-decoration: none;

            font-weight: 600;

        }

        .switch a:hover {

            text-decoration: underline;

        }

        /* ERROR */

        .error {

            background:
            rgba(255,0,0,0.1);

            padding: 14px;

            border-radius: 14px;

            margin-bottom: 20px;

            color: #ffb4b4;

        }

    </style>

</head>

<body>

<div class="glow one"></div>

<div class="glow two"></div>

<div class="auth-container">

    <!-- LEFT -->

    <div class="left">

        <div class="logo">

            🔥 CareerForge

        </div>

        <h1>

            Build Your Career Journey

        </h1>

        <p>

            CareerForge helps students prepare for assessments,
            generate professional resumes,
            improve skills,
            and explore career opportunities.

        </p>

    </div>

    <!-- RIGHT -->

    <div class="right">

        <div class="auth-card">

            <h2>

                Welcome Back 👋

            </h2>

            @if(session('error'))

                <div class="error">

                    {{ session('error') }}

                </div>

            @endif

            @if(session('success'))

                <div class="error"
                     style="background:rgba(0,255,0,0.1);
                            color:lightgreen;">

                    {{ session('success') }}

                </div>

            @endif

            <form method="POST"
                  action="/login">

                @csrf

                <!-- EMAIL -->

                <div class="input-group">

                    <label>

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >

                </div>

                <!-- PASSWORD -->

                <div class="input-group">

                    <label>

                        Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                </div>

                <!-- BUTTON -->

                <button
                    type="submit"
                    class="btn"
                >

                    Login

                </button>

            </form>

            <!-- REGISTER -->

            <div class="switch">

                Don’t have an account?

                <a href="/register">

                    Create Account

                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>