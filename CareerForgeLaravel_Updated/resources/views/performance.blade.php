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
                <div style="margin-top:20px;">

    <a href="/download-performance-report"
       style="
        display:inline-block;
        padding:10px 18px;
        background:#8b5cf6;
        color:white;
        border-radius:10px;
        text-decoration:none;
        font-weight:600;
        font-size:14px;
       ">

        📄 Download Report

    </a>

</div>

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

            <div style="
                display:grid;
                grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
                gap:20px;
            ">

                <div class="stat-card">

                    <h3>
                        Average Score
                    </h3>

                    <p>
                        {{ $averageScore }}%
                    </p>

                </div>

                <div class="stat-card">

                    <h3>
                        Highest Score
                    </h3>

                    <p>
                        {{ $highestScore }}
                    </p>

                </div>

                <div class="stat-card">

                    <h3>
                        Lowest Score
                    </h3>

                    <p>
                        {{ $lowestScore }}
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

        <!-- SKILL ANALYTICS -->

        <div class="card"
             style="margin-bottom:30px;">

            <h2 style="margin-bottom:25px;">
                🧠 Skill Analytics
            </h2>

            <div style="
                display:grid;
                grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
                gap:20px;
            ">

                <div class="stat-card">

                    <h3>
                        {{ $strongestSkill }}
                    </h3>

                    <p>
                        Strongest Skill
                    </p>

                </div>

                <div class="stat-card">

                    <h3>
                        {{ $weakestSkill }}
                    </h3>

                    <p>
                        Weakest Skill
                    </p>

                </div>

                <div class="stat-card">

                    <h3>
                        {{ $recommendedSkill }}
                    </h3>

                    <p>
                        Recommended Learning
                    </p>

                </div>

                <div class="stat-card">

                    <h3>
                        {{ $careerReadiness }}%
                    </h3>

                    <p>
                        Career Readiness
                    </p>

                </div>

            </div>

        </div>

        <!-- SKILL PROGRESS -->

        <div class="card"
             style="margin-bottom:30px;">

            <h2 style="margin-bottom:25px;">
                ⚡ Skill Progress
            </h2>

            <div style="margin-bottom:20px;">

                <p>HTML</p>

                <progress value="90"
                          max="100"
                          style="width:100%; height:18px;">
                </progress>

            </div>

            <div style="margin-bottom:20px;">

                <p>CSS</p>

                <progress value="80"
                          max="100"
                          style="width:100%; height:18px;">
                </progress>

            </div>

            <div style="margin-bottom:20px;">

                <p>JavaScript</p>

                <progress value="65"
                          max="100"
                          style="width:100%; height:18px;">
                </progress>

            </div>

        </div>

        <!-- WEEKLY PROGRESS CHART -->

        <div class="card"
             style="margin-bottom:30px;">

            <h2 style="margin-bottom:25px;">
                📈 Weekly Progress Chart
            </h2>

            <canvas id="progressChart"
                    height="100"></canvas>

        </div>

        <!-- WEEKLY REPORT -->

        <div class="card"
             style="margin-bottom:30px;">

            <h2 style="margin-bottom:25px;">
                📅 Weekly Performance Report
            </h2>

            <div style="
                display:grid;
                grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
                gap:20px;
            ">

                <div class="stat-card">

                    <h3>
                        {{ $weeklyQuizCount }}
                    </h3>

                    <p>
                        Weekly Quizzes
                    </p>

                </div>

                <div class="stat-card">

                    <h3>
                        {{ $weeklyAverage }}%
                    </h3>

                    <p>
                        Weekly Average
                    </p>

                </div>

            </div>

            <div class="card"
                 style="
                    margin-top:25px;
                    background:rgba(139,92,246,0.1);
                    border:1px solid rgba(139,92,246,0.4);
                 ">

                <h3 style="margin-bottom:10px;">
                    📢 Weekly Insight
                </h3>

                <p>
                    {{ $weeklyMessage }}
                </p>

            </div>

        </div>
        <!-- ACHIEVEMENT BADGES -->

<div class="card"
     style="margin-bottom:30px;">

    <h2 style="margin-bottom:25px;">
        🏅 Achievement Badges
    </h2>

    <div style="
        display:flex;
        flex-wrap:wrap;
        gap:15px;
    ">

        @forelse($badges as $badge)

            <div style="
                padding:12px 18px;
                border-radius:12px;
                background:rgba(139,92,246,0.15);
                border:1px solid rgba(139,92,246,0.4);
                font-weight:600;
            ">

                {{ $badge }}

            </div>

        @empty

            <p>
                No badges earned yet.
            </p>

        @endforelse

    </div>

</div>

        <!-- AI RECOMMENDATION -->

        <div class="card"
             style="margin-bottom:30px;">

            <h2 style="margin-bottom:20px;">
                🤖 AI Career Recommendation
            </h2>

            <p style="
                font-size:16px;
                line-height:1.8;
                opacity:0.9;
            ">

                {{ $recommendation }}

            </p>

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

<!-- CHART JS -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const ctx = document.getElementById('progressChart');

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: @json($chartLabels),

            datasets: [{

                label: 'Performance Score',

                data: @json($chartScores),

                borderColor: '#8b5cf6',

                backgroundColor: 'rgba(139, 92, 246, 0.2)',

                tension: 0.4,

                fill: true

            }]

        },

        options: {

            responsive: true,

            plugins: {

                legend: {

                    labels: {
                        color: '#ffffff'
                    }

                }

            },

            scales: {

                x: {

                    ticks: {
                        color: '#ffffff'
                    }

                },

                y: {

                    ticks: {
                        color: '#ffffff'
                    }

                }

            }

        }

    });

</script>

</body>

</html>
