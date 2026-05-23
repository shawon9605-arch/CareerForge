<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        CareerForge Dashboard
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

        <a href="/"
           class="active">

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

        <a href="/performance">

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

                    Welcome Back 👋

                </h1>

                <p style="opacity:0.7; margin-top:-10px;">

                    Track your career growth & upcoming activities

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
                    Skills Added
                </p>

            </div>

            <div class="stat-card">

                <h3>
                    75%
                </h3>

                <p>
                    Job Readiness
                </p>

            </div>

            <div class="stat-card">

                <h3>
                    {{ count($events) }}
                </h3>

                <p>
                    Upcoming Events
                </p>

            </div>

        </div>

        <!-- SKILLS -->

        <div class="card"
             style="margin-bottom:30px;">

            <div class="section-header">

                <h2>
                    🚀 Your Skills
                </h2>

            </div>

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

        <!-- PROFILE INFO -->

        <div class="card"
             style="margin-bottom:30px;">

            <h2 style="margin-bottom:25px;">

                👤 Profile Information

            </h2>

            <div style="display:grid;
                        grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
                        gap:20px;">

                <div>

                    <p style="opacity:0.6; margin-bottom:8px;">
                        Email
                    </p>

                    <h3>
                        {{ $user->email ?? '' }}
                    </h3>

                </div>

                <div>

                    <p style="opacity:0.6; margin-bottom:8px;">
                        GPA
                    </p>

                    <h3>
                        {{ $user->gpa ?? 'N/A' }}
                    </h3>

                </div>

                <div>

                    <p style="opacity:0.6; margin-bottom:8px;">
                        Interests
                    </p>

                    <h3>
                        {{ $user->interests ?? 'Not Added' }}
                    </h3>

                </div>

            </div>

        </div>

        <!-- EVENTS -->

        <div class="card"
             style="margin-bottom:30px;">

            <div class="section-header">

                <h2>
                    📅 Upcoming Events
                </h2>

                <a href="/events"
                   class="view-all">

                    View All

                </a>

            </div>

            @if(count($events) > 0)

                @foreach($events as $event)

                    <div class="event-item">

                        <div class="event-badge">

                            {{ $event->type }}

                        </div>

                        <div class="event-content">

                            <h4>

                                {{ $event->title }}

                            </h4>

                            <p>

                                📅 {{ $event->event_date }}

                            </p>

                        </div>

                    </div>

                @endforeach

            @else

                <p style="opacity:0.7;">

                    No upcoming events added yet.

                </p>

            @endif

        </div>

        <!-- RECOMMENDED JOB -->

        <div class="card">

            <div class="section-header">

                <h2>
                    💼 Recommended Job
                </h2>

                <a href="/jobs"
                   class="view-all">

                    Explore Jobs

                </a>

            </div>

            <div class="job-card">

                <div class="match">
                    80% Match
                </div>

                <h2>
                    Frontend Developer
                </h2>

                <p class="company">
                    Tech Solutions Ltd.
                </p>

                <div class="tags">

                    <span>
                        HTML
                    </span>

                    <span>
                        CSS
                    </span>

                    <span>
                        JavaScript
                    </span>

                </div>

                <button>
                    Apply Now
                </button>

            </div>

        </div>

    </div>

</div>

</body>

</html>
```
