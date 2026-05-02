<!DOCTYPE html>
<html>
<head>
    <title>CareerForge</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b, #312e81);
            color: white;
        }


        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 60px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .nav-buttons a {
            padding: 10px 18px;
            border-radius: 10px;
            margin-left: 10px;
            text-decoration: none;
        }

        .btn-main {
            background: linear-gradient(45deg, #ff7a00, #ffb347);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid #ff7a00;
            color: #ff7a00;
        }


        .center-box {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .center-box h1 {
            font-size: 42px;
        }

        .support {
            color: #ff7a00;
            border-bottom: 2px solid #ff7a00;
            text-decoration: none;
        }

        .hero-image img {
            width: 100%;
            max-width: 700px;
            border-radius: 12px;
            margin: 20px 0;
        }

        .sub-text {
            color: #aaa;
            font-size: 14px;
        }


        .features {
            padding: 80px 60px;
            text-align: center;
        }

        .features h2 {
            font-size: 32px;
            margin-bottom: 40px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }

        .feature-box {
            background: rgba(255,255,255,0.08);
            padding: 30px;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            transition: 0.3s;
            cursor: pointer;
        }

        .feature-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 0 20px rgba(255,122,0,0.3);
        }

        .feature-box img {
            width: 50px;
            margin-bottom: 15px;
        }


        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stat-box {
            background: rgba(255,255,255,0.08);
            padding: 30px;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            text-align: center;
            transition: 0.3s;
        }

        .stat-box:hover {
            transform: translateY(-5px);
        }

        .stat-box h3 {
            font-size: 28px;
            color: #ffb347;
        }

        .stat-box p {
            color: #ccc;
        }
    </style>
</head>

<body>


<div class="navbar">
    <div class="logo">🚀 CareerForge</div>
    <div class="nav-buttons">
        <a href="register.php" class="btn-main">Start Learning</a>
        <a href="login.php" class="btn-outline-custom">Login</a>
    </div>
</div>


<div class="center-box">
    <div style="max-width:700px; width:100%;">

        <h1>
            Learn Skills in Bangladesh —
            <a href="#" class="support">Support●</a>
        </h1>

        <div class="hero-image">
            <img src="homepages.jpg">
        </div>

        <p>Transform your career through skill-based learning</p>

        <p class="sub-text">
            10,000+ graduates are working in local & international companies
        </p>

    </div>
</div>


<div class="features">

    <h2>What You Get in the Live Course</h2>

    <div class="feature-grid">

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/briefcase.png"/>
            <p>Job-ready dedicated placement team</p>
        </div>

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/resume.png"/>
            <p>CV building & expert CV review</p>
        </div>

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/customer-support.png"/>
            <p>18 hours of live support</p>
        </div>

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/medal.png"/>
            <p>Pro batch special CV & job support</p>
        </div>

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/test-passed.png"/>
            <p>Opportunity through live tests</p>
        </div>

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/puzzle.png"/>
            <p>24/7 days support</p>
        </div>

    </div>


    <div class="stats">

        <div class="stat-box">
            <h3>9,000+</h3>
            <p>Job Placements</p>
        </div>

        <div class="stat-box">
            <h3>150,000+</h3>
            <p>Learners</p>
        </div>

        <div class="stat-box">
            <h3>83%</h3>
            <p>Completion Rate</p>
        </div>

        <div class="stat-box">
            <h3>28</h3>
            <p>Live Courses</p>
        </div>

    </div>

</div>

</body>
</html>
