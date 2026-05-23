<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Performance Analysis
    </title>

    <link rel="stylesheet"
          href="{{ asset('assets/style.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

</head>

<body>

<div class="dashboard">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <h2>
            🔥 CareerForge
        </h2>

        <a href="/">

            🏠 Dashboard

        </a>

        <a href="/profile">

            👤 Profile

        </a>

        <a href="/jobs">

            💼 Jobs

        </a>

        <a href="/community">

            🌍 Community

        </a>

        <a href="/quizzes">

            📚 Assessments

        </a>

        <a href="/performance"
           class="active">

            📈 Performance

        </a>

        <a href="/events">

            📅 Calendar

        </a>

        <a href="/logout"
           class="logout-btn">

            🚪 Logout

        </a>

    </div>

    <!-- MAIN -->

    <div class="main">

        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1 class="page-title">

                    Performance Analysis 📈

                </h1>

                <p style="opacity:0.7; margin-top:-10px;">

                    Track your growth and learning progress

                </p>

            </div>

            <div class="profile">

                <img
                    src="{{ asset($user->image ?? 'assets/user.png') }}"
                    class="topbar-profile-img"
                >

                <div>

                    <strong>

                        {{ $user->name ?? 'Student' }}

                    </strong>

                    <p style="opacity:0.6; font-size:13px; margin-top:4px;">

                        CareerForge User

                    </p>

                </div>

            </div>

        </div>

        <!-- STATS -->

        <div class="stats">

            <div class="stat-card">

                <h3>
                    {{ count($skills) }}
                </h3>

                <p>
                    Skills Learned
                </p>

            </div>

            <div class="stat-card">

                <h3>
                    {{ $overallProgress }}%
                </h3>

                <p>
                    Overall Progress
                </p>

            </div>

            <div class="stat-card">

                <h3>
                    {{ $completedAssessments }}
                </h3>

                <p>
                    Completed Assessments
                </p>

            </div>

        </div>

        <!-- PERFORMANCE OVERVIEW -->

        <div class="card"
             style="margin-bottom:30px;">

            <h2 style="margin-bottom:25px;">

                📊 Performance Overview

            </h2>

            <div style="display:grid;
                        grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
                        gap:20px;">

                <div class="stat-card">

                    <h3>
                        HTML
                    </h3>

                    <p>
                        90% Mastery
                    </p>

                </div>

                <div class="stat-card">

                    <h3>
                        CSS
                    </h3>

                    <p>
                        85% Mastery
                    </p>

                </div>

                <div class="stat-card">

                    <h3>
                        JavaScript
                    </h3>

                    <p>
                        70% Mastery
                    </p>

                </div>

            </div>

        </div>

        <!-- RECENT ACTIVITY -->

        <div class="card"
             style="margin-bottom:30px;">

            <h2 style="margin-bottom:25px;">

                🚀 Recent Activity

            </h2>

            <div class="event-item">

                <div class="event-badge">
                    Quiz
                </div>

                <div class="event-content">

                    @if($latestQuiz)

                        <h4>
                            Latest Quiz Completed
                        </h4>

                        <p>
                            Score: {{ $latestQuiz->score }}
                        </p>

                    @else

                        <h4>
                            No Quiz Attempted Yet
                        </h4>

                        <p>
                            Start giving quizzes
                        </p>

                    @endif

                </div>

            </div>

            <div class="event-item">

                <div class="event-badge">
                    Skill
                </div>

                <div class="event-content">

                    @if(count($skills) > 0)

                        <h4>
                            Added {{ end($skills) }} Skill
                        </h4>

                        <p>
                            Recently updated profile skills
                        </p>

                    @else

                        <h4>
                            No Skills Added Yet
                        </h4>

                        <p>
                            Update your profile skills
                        </p>

                    @endif

                </div>

            </div>

        </div>

        <!-- GOALS -->

        <div class="card">

            <h2 style="margin-bottom:25px;">

                🎯 Career Goals

            </h2>

            <div class="tags">

                <span class="tag">
                    Frontend Development
                </span>

                <span class="tag">
                    Full Stack Engineering
                </span>

                <span class="tag">
                    UI/UX Design
                </span>

            </div>

        </div>

    </div>

</div>

</body>

</html>
