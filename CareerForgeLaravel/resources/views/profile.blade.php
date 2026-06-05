<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        CareerForge Profile
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

        <a href="/profile"
           class="active">

            👤 Profile

        </a>

        <a href="/jobs">

            💼 Jobs

        </a>

        <a href="/community">

            🌍 Community

        </a>

        <a href="/resource-recommendation">

    📖 Resources

</a>

        <a href="/quizzes">

            📚 Assessments

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

                    👤 My Profile

                </h1>

                <p style="opacity:0.7; margin-top:-10px;">

                    Manage your personal & professional information

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

        <!-- PROFILE CONTAINER -->

        <div class="profile-container">

            <!-- LEFT -->

            <div class="profile-left">

                <img
                    src="{{ asset($user->image ?? 'assets/user.png') }}"
                    class="profile-img"
                >

                <h2 style="margin-bottom:10px;">

                    {{ $user->name ?? 'Student' }}

                </h2>

                <p style="opacity:0.7; margin-bottom:20px;">

                    {{ $user->email ?? '' }}

                </p>

                <!-- CV BUTTONS -->

                <a href="/cv"
                   class="btn"
                   style="display:block; margin-bottom:15px; text-align:center;">

                    📄 View CV

                </a>

                <a href="/cv/download"
                   class="btn"
                   style="display:block; text-align:center;">

                    ⬇ Download CV

                </a>

                <!-- PROFILE STATS -->

                <div style="
                    margin-top:30px;
                    display:grid;
                    gap:15px;
                ">

                    <div class="card"
                         style="padding:18px; border-radius:20px;">

                        <h3>

                            {{ $user->gpa ?? 'N/A' }}

                        </h3>

                        <p style="opacity:0.7;">

                            GPA

                        </p>

                    </div>

                    <div class="card"
                         style="padding:18px; border-radius:20px;">

                        <h3>

                            {{ count(explode(',', $user->skills ?? '')) }}

                        </h3>

                        <p style="opacity:0.7;">

                            Skills Added

                        </p>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="profile-right">

                <!-- FORM CARD -->

                <div class="card">

                    <h2 style="margin-bottom:30px;">

                        ✨ Update Information

                    </h2>
                    @if(session('success'))

                        <div style="
                            background:
                            linear-gradient(
                                90deg,
                                #10b981,
                                #059669
                            );

                            padding:16px;

                            border-radius:16px;

                            margin-bottom:25px;

                            color:white;

                            font-weight:600;
                        ">

                            ✅ {{ session('success') }}

                        </div>

                    @endif
                    <form method="POST"
                          action="/profile/update"
                          enctype="multipart/form-data">

                        @csrf

                        <!-- NAME -->

                        <label style="margin-bottom:10px; display:block; opacity:0.7;">

                            Full Name

                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ $user->name ?? '' }}"
                            placeholder="Enter your name"
                        >

                        <br><br>

                        <!-- GPA -->

                        <label style="margin-bottom:10px; display:block; opacity:0.7;">

                            GPA

                        </label>

                        <input
                            type="text"
                            name="gpa"
                            value="{{ $user->gpa ?? '' }}"
                            placeholder="Enter GPA"
                        >

                        <br><br>

                        <!-- SKILLS -->

                        <label style="margin-bottom:10px; display:block; opacity:0.7;">

                            Skills

                        </label>

                        <textarea
                            name="skills"
                            placeholder="HTML, CSS, JavaScript..."
                        >{{ $user->skills ?? '' }}</textarea>

                        <br><br>

                        <!-- INTERESTS -->

                        <label style="margin-bottom:10px; display:block; opacity:0.7;">

                            Interests

                        </label>

                        <textarea
                            name="interests"
                            placeholder="AI, Web Development..."
                        >{{ $user->interests ?? '' }}</textarea>

                        <br><br>

                        <!-- EDUCATION -->

                        <label style="margin-bottom:10px; display:block; opacity:0.7;">

                            Education

                        </label>

                        <textarea
                            name="education"
                            placeholder="Your educational background..."
                        >{{ $user->education ?? '' }}</textarea>

                        <br><br>

                        <!-- EXPERIENCE -->

                        <label style="margin-bottom:10px; display:block; opacity:0.7;">

                            Experience

                        </label>

                        <textarea
                            name="experience"
                            placeholder="Internships, projects..."
                        >{{ $user->experience ?? '' }}</textarea>

                        <br><br>

                        <!-- PROJECTS -->

                        <label style="margin-bottom:10px; display:block; opacity:0.7;">

                            Projects

                        </label>

                        <textarea
                            name="projects"
                            placeholder="Describe your projects..."
                        >{{ $user->projects ?? '' }}</textarea>

                        <br><br>

                        <!-- PROFILE IMAGE -->

                        <label style="margin-bottom:10px; display:block; opacity:0.7;">

                            Upload Profile Image

                        </label>

                        <input
                            type="file"
                            name="profile_image"
                        >

                        <br><br>

                        <!-- SAVE BUTTON -->

                        <button
                            type="submit"
                            class="save-btn">

                            💾 Save Changes

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
