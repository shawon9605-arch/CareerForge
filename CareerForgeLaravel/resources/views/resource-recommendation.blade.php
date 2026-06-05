<!DOCTYPE html>

<html lang="en">
<head>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Job Resources Hub</title>

<link rel="stylesheet"
      href="{{ asset('assets/style.css') }}">


</head>

<body>

<div class="dashboard">


<div class="sidebar">

    <h2>🔥 CareerForge</h2>

    <a href="/">🏠 Dashboard</a>

    <a href="/profile">👤 Profile</a>

    <a href="/jobs">💼 Jobs</a>

    <a href="/community">🌍 Community</a>

    <a href="/resource-recommendation"
       class="active">

        📚 Resources

    </a>

    <a href="/quizzes">📚 Assessments</a>

    <a href="/events">📅 Calendar</a>

    <a href="/logout"
       class="logout-btn">

        🚪 Logout

    </a>

</div>

<div class="main">



    <!-- ADD RESOURCE FORM HERE -->


<div class="resources-hero">

    <h1>🚀 Job Resources Hub</h1>

    <p>
        Interview guides, CV templates, career articles and learning resources.
    </p>

</div>

<div class="resource-search">

    <form method="GET"
          action="/resource-recommendation">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search interview guides, CV templates, courses...">

    </form>

</div>

<div class="resource-grid">

    <div class="resource-left">

        @foreach($resources as $resource)

        <div class="resource-card">

            <span class="resource-badge">
                {{ $resource->category }}
            </span>

            @if($resource->image)

    <img
        src="{{ asset('uploads/resources/'.$resource->image) }}"
        class="resource-image"
        alt="{{ $resource->title }}">

    @endif

            <h2>{{ $resource->title }}</h2>




            <p>{{ $resource->type }}</p>



            <p class="resource-desc">
                {{ $resource->description }}
            </p>

            <a href="{{ $resource->link }}"
               target="_blank">

               🚀 Open Resource

            </a>

        </div>

        @endforeach

    </div>

    <div class="resource-right">


<div class="resource-card">

    <h2>📂 Categories</h2>

    <a href="/resource-recommendation"
       class="resource-all-btn">

       📚 All Resources

    </a>

    <ul>

        <li>
            <a href="/resource/category/Interview%20Preparation">
                Interview Preparation
            </a>
        </li>

        <li>
            <a href="/resource/category/CV%20Templates">
                CV Templates
            </a>
        </li>

        <li>
            <a href="/resource/category/Career%20Growth">
                Career Growth
            </a>
        </li>

        <li>
            <a href="/resource/category/Programming">
                Programming
            </a>
        </li>

        <li>
            <a href="/resource/category/Documentation">
                Documentation
            </a>
        </li>

    </ul>

</div>

<div class="resource-card">

    <h2>📊 Resource Statistics</h2>

    <p>Total Resources: {{ count($resources) }}</p>

    <p>Career Resources Available</p>

    <p>Job Preparation Support 🚀</p>

</div>


</div>

</div> <!-- resource-grid -->

</div> <!-- main -->

</div> <!-- dashboard -->

</body>
</html>
