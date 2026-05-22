<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerForge Dashboard</title>

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2>🔥 CareerForge</h2>

        <a href="{{ url('/') }}">
            Dashboard
        </a>

        <a href="{{ url('/profile') }}">
            Profile
        </a>

        <a href="{{ url('/jobs') }}">
            Jobs
        </a>

        <a href="{{ url('/community') }}">
            Community
        </a>

        <a href="{{ url('/quizzes') }}">
            Quizzes
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

            <h1>
                Welcome Back 👋
            </h1>

            <div class="profile">

                <img
                    src="{{ asset($user->image ?? 'assets/user.png') }}"
                    class="topbar-profile-img"
                >

                <span>
                    {{ $user->name ?? 'Student' }}
                </span>

            </div>

        </div>

        <!-- STATS -->
        <div class="stats">

            <div class="progress-card">
                <div class="circle">
                    <span>75%</span>
                </div>

                <p>Job Readiness</p>
            </div>

            <div class="stat-card">
                <h3>{{ count($skills) }}</h3>
                <p>Skills</p>
            </div>

            <div class="stat-card">
                <h3>3</h3>
                <p>Jobs Matched</p>
            </div>

        </div>

        <!-- SKILLS -->
        <div class="card">

            <h3>Your Skills</h3>

            <div class="tags">

                @foreach($skills as $skill)

                    @if(trim($skill) != '')

                        <span class="tag">
                            {{ trim($skill) }}
                        </span>

                    @endif

                @endforeach

            </div>

        </div>

        <!-- PROFILE -->
        <div class="card">

            <h3>Profile Info</h3>

            <p><strong>Email:</strong> {{ $user->email ?? '' }}</p>

            <p><strong>GPA:</strong> {{ $user->gpa ?? '' }}</p>

            <p><strong>Interests:</strong> {{ $user->interests ?? '' }}</p>

        </div>

        <!-- JOBS -->
        <div class="card">

            <h3>Recommended Jobs</h3>

            <div class="job-list">

                <div class="job-card">

                    <div class="job-top">
                        <h3>Frontend Developer</h3>

                        <span class="match">80%</span>
                    </div>

                    <p class="company">
                        Tech Solutions Ltd.
                    </p>

                    <div class="tags">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>JavaScript</span>
                    </div>

                    <div class="job-bottom">
                        <span class="location">📍 Remote</span>

                        <button>
                            Apply
                        </button>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>