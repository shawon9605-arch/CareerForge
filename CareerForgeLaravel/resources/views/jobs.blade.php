@if(empty($jobs))

<h1>No jobs found</h1>

@endif
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>CareerForge Jobs</title>

    <link rel="stylesheet"
          href="{{ asset('assets/style.css') }}">

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


    </div>

    <!-- MAIN -->
    <div class="main">

        <h1>💼 Job Recommendations</h1>

        <!-- SEARCH -->
        <div class="search-bar">

            <input
                type="text"
                id="searchInput"
                placeholder="🔍 Search jobs..."
            >

        </div>

        <!-- JOBS -->
        <div class="job-list">

            @foreach($jobs as $job)

                <div class="job-card">

                    <div class="job-top">

                        <h3>
                            {{ $job['title'] }}
                        </h3>

                        <span class="match">
                            {{ $job['match'] }}%
                        </span>

                    </div>

                    <p class="company">
                        {{ $job['company'] }}
                    </p>

                    <div class="tags">

                        @foreach($job['skills'] as $skill)

                            <span>
                                {{ strtoupper($skill) }}
                            </span>

                        @endforeach

                    </div>

                    <div class="job-bottom">

                        <span class="location">
                            📍 {{ $job['location'] }}
                        </span>

                        <button>
                            Apply
                        </button>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

<!-- SEARCH JS -->

<script>

document
.getElementById("searchInput")

.addEventListener("keyup", function () {

    let filter =
    this.value.toLowerCase();

    let jobs =
    document.querySelectorAll(".job-card");

    jobs.forEach(function(job) {

        let text =
        job.innerText.toLowerCase();

        if (text.includes(filter)) {

            job.style.display = "block";

        } else {

            job.style.display = "none";

        }

    });

});

</script>

</body>
</html>