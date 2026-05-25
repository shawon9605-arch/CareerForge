<!DOCTYPE html>
<html>

<head>

    <title>
        Performance Report
    </title>

    <style>

        body {
            font-family: sans-serif;
            padding: 30px;
        }

        h1 {
            color: #6d28d9;
        }

        .card {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

    </style>

</head>

<body>

<h1>
    CareerForge Performance Report
</h1>

<div class="card">

    <h2>
        User Information
    </h2>

    <p>
        <strong>Name:</strong>
        {{ $user->name }}
    </p>

</div>

<div class="card">

    <h2>
        Skills
    </h2>

    <p>
        {{ implode(', ', $skills) }}
    </p>

</div>

<div class="card">

    <h2>
        Performance Statistics
    </h2>

    <p>
        Completed Assessments:
        {{ $completedAssessments }}
    </p>

    <p>
        Average Score:
        {{ round($averageScore) }}%
    </p>

    <p>
        Career Readiness:
        {{ $careerReadiness }}%
    </p>

</div>

</body>

</html>
