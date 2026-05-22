<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        CareerForge Register
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

        .auth-box {

            width: 500px;

            padding: 55px;

            border-radius: 35px;

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

        h1 {

            color: white;

            text-align: center;

            margin-bottom: 35px;

            font-size: 40px;

        }

        .input-group {

            margin-bottom: 22px;

        }

        label {

            display: block;

            margin-bottom: 10px;

            color:
            rgba(255,255,255,0.75);

        }

        input {

            width: 100%;

            padding: 16px;

            border-radius: 16px;

            border:
            1px solid rgba(255,255,255,0.08);

            background:
            rgba(255,255,255,0.06);

            color: white;

            outline: none;

        }

        input::placeholder {

            color:
            rgba(255,255,255,0.45);

        }

        input:focus {

            border-color: #7c3aed;

            box-shadow:
            0 0 0 4px rgba(124,58,237,0.2);

        }

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

<div class="auth-box">

    <h1>

        Create Account 🚀

    </h1>

    @if(session('error'))

        <div class="error">

            {{ session('error') }}

        </div>

    @endif

    <form method="POST"
          action="/register">

        @csrf

        <div class="input-group">

            <label>

                Full Name

            </label>

            <input
                type="text"
                name="name"
                placeholder="Enter your full name"
                required
            >

        </div>

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

        <div class="input-group">

            <label>

                Password

            </label>

            <input
                type="password"
                name="password"
                placeholder="Create a password"
                required
            >

        </div>

        <button
            type="submit"
            class="btn"
        >

            Register

        </button>

    </form>

    <div class="switch">

        Already have an account?

        <a href="/login">

            Login

        </a>

    </div>

</div>

</body>

</html>