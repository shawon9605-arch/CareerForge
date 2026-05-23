<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        CareerForge Jobs
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

        <a href="/jobs"
           class="active">

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

                    💼 Job Recommendations

                </h1>

                <p style="opacity:0.7; margin-top:-10px;">

                    Explore opportunities based on your skills & interests

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

        <!-- SEARCH -->

        <div class="card"
             style="margin-bottom:30px;">

            <div class="search-bar">

                <input
                    type="text"
                    id="jobSearch"
                    placeholder="🔍 Search jobs, companies, skills..."
                    onkeyup="searchJobs()"
                >

            </div>

        </div>

        <!-- JOB GRID -->

        <div class="job-list">

            @foreach($jobs as $job)

                <div class="job-card searchable-job">

                    <!-- TOP -->

                    <div style="
                        display:flex;
                        justify-content:space-between;
                        align-items:flex-start;
                        gap:20px;
                        margin-bottom:20px;
                    ">

                        <div>

                            <h2 style="margin-bottom:8px;">

                                {{ $job->title }}

                            </h2>

                            <p class="company">

                                {{ $job->company }}

                            </p>

                        </div>

                        <div class="match">

                            {{ $job->match_percentage ?? '80%' }}
                            Match

                        </div>

                    </div>

                    <!-- DESCRIPTION -->

                    <p style="
                        opacity:0.75;
                        line-height:1.8;
                        margin-bottom:25px;
                    ">

                        {{ $job->description }}

                    </p>

                    <!-- TAGS -->

                    <div class="tags">

                        <span>

                            {{ $job->category }}

                        </span>

                        <span>

                            Remote

                        </span>

                        <span>

                            Full-Time

                        </span>

                    </div>

                    <!-- FOOTER -->

                    <div style="
                        display:flex;
                        justify-content:space-between;
                        align-items:center;
                        margin-top:25px;
                        gap:20px;
                        flex-wrap:wrap;
                    ">

                        <div class="location">

                            📍 {{ $job->location }}

                        </div>

                        <button
                            onclick="openApplyModal(
                                '{{ $job->title }}',
                                '{{ $job->company }}'
                            )">

                            Apply Now

                        </button>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

<!-- APPLY MODAL -->

<div id="applyModal"
     style="
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.65);
        display:none;
        justify-content:center;
        align-items:center;
        z-index:9999;
     ">

    <div class="card"
         style="
            width:520px;
            max-width:92%;
         ">

        <div class="section-header">

            <h2>

                🚀 Apply Job

            </h2>

            <button
                onclick="closeApplyModal()"
                style="
                    width:42px;
                    height:42px;
                    border-radius:12px;
                    padding:0;
                ">

                ✕

            </button>

        </div>

        <form>

            <label style="display:block; margin-bottom:10px; opacity:0.7;">

                Job Position

            </label>

            <input
                type="text"
                id="jobTitle"
                readonly
            >

            <br><br>

            <label style="display:block; margin-bottom:10px; opacity:0.7;">

                Company

            </label>

            <input
                type="text"
                id="companyName"
                readonly
            >

            <br><br>

            <label style="display:block; margin-bottom:10px; opacity:0.7;">

                Full Name

            </label>

            <input
                type="text"
                value="{{ $user->name ?? '' }}"
            >

            <br><br>

            <label style="display:block; margin-bottom:10px; opacity:0.7;">

                Email

            </label>

            <input
                type="email"
                value="{{ $user->email ?? '' }}"
            >

            <br><br>

            <label style="display:block; margin-bottom:10px; opacity:0.7;">

                Cover Letter

            </label>

            <textarea
                placeholder="Write your cover letter..."
            ></textarea>

            <br><br>

            <label style="display:block; margin-bottom:10px; opacity:0.7;">

                Upload CV

            </label>

            <input
                type="file"
            >

            <br><br>

            <button
                type="button"
                style="width:100%;">

                Submit Application

            </button>

        </form>

    </div>

</div>

<!-- SCRIPT -->

<script>

    function openApplyModal(
        title,
        company
    ) {

        document
            .getElementById('applyModal')
            .style.display = 'flex';

        document
            .getElementById('jobTitle')
            .value = title;

        document
            .getElementById('companyName')
            .value = company;

    }

    function closeApplyModal() {

        document
            .getElementById('applyModal')
            .style.display = 'none';

    }

    function searchJobs() {

        let input =
        document
            .getElementById(
                'jobSearch'
            )
            .value
            .toLowerCase();

        let jobs =
        document.querySelectorAll(
            '.searchable-job'
        );

        jobs.forEach((job) => {

            let text =
            job.innerText.toLowerCase();

            if(text.includes(input)) {

                job.style.display = 'block';

            }

            else {

                job.style.display = 'none';

            }

        });

    }

</script>

</body>

</html>
