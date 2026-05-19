<?php
/** @var object $user */
/** @var array<int, string> $skills */
?>

<!DOCTYPE html>
<html>
<head>
    <title>My CV</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b, #312e81);
            font-family: 'Poppins', sans-serif;
            color: white;
            padding: 40px;
        }

        .cv-container {
            max-width: 800px;
            margin: auto;
            background: rgba(255,255,255,0.08);
            padding: 30px;
            border-radius: 16px;
            backdrop-filter: blur(10px);
        }

        .cv-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .cv-header h1 {
            margin: 0;
            font-size: 28px;
        }

        .cv-header p {
            color: #ccc;
        }

        .cv-section {
            margin-bottom: 25px;
        }

        .cv-section h3 {
            margin-bottom: 10px;
            color: #ffb347;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tag {
            background: rgba(255,255,255,0.12);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .btn-download {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 12px;
            border-radius: 10px;
            background: linear-gradient(45deg, #ff7a00, #ffb347);
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="cv-container">

    <!-- HEADER -->
    <div class="cv-header">
        <h1>{{ $user->name ?? 'Student' }}</h1>
        <p>{{ $user->email ?? '' }}</p>
    </div>

    <!-- ACADEMIC -->
    <div class="cv-section">
        <h3>🎓 Academic</h3>
        <p>GPA: {{ $user->gpa ?? '' }}</p>
    </div>

    <!-- SKILLS -->
    <div class="cv-section">
        <h3>💡 Skills</h3>
        <div class="tags">
            @foreach($skills as $skill)
                @if(trim($skill) !== '')
                    <span class="tag">{{ trim($skill) }}</span>
                @endif
            @endforeach
        </div>
    </div>

    <!-- INTERESTS -->
    <div class="cv-section">
        <h3>🎯 Interests</h3>
        <p>{{ $user->interests ?? '' }}</p>
    </div>

    <!-- DOWNLOAD -->
    <a href="#" onclick="window.print()" class="btn-download">⬇ Download / Print CV</a>

</div>

</body>
</html>
