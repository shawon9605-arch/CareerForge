<!DOCTYPE html>
<html>

<head>

    <title>CareerForge CV</title>

    <style>

        body {

            margin: 0;
            padding: 0;

            font-family: Arial, sans-serif;

            background: #f3f4f6;

            color: #111827;

        }

        .container {

            width: 85%;

            margin: 30px auto;

            background: white;

            border-radius: 20px;

            overflow: hidden;

            box-shadow:
            0 15px 40px rgba(0,0,0,0.15);

        }

        /* HEADER */

        .header {

            background:
            linear-gradient(
                90deg,
                #4f46e5,
                #7c3aed
            );

            color: white;

            padding: 45px;

            display: flex;
            align-items: center;

        }

        .profile-circle {

            width: 120px;
            height: 120px;

            border-radius: 50%;

            background:
            rgba(255,255,255,0.2);

            border:
            4px solid rgba(255,255,255,0.5);

            margin-right: 30px;

            overflow: hidden;

        }

        .profile-circle img {

            width: 100%;
            height: 100%;

            object-fit: cover;

        }

        .header-content h1 {

            margin: 0;
            font-size: 42px;

        }

        .header-content p {

            margin: 8px 0;
            font-size: 16px;

            opacity: 0.9;

        }

        /* BODY */

        .content {

            padding: 40px;

        }

        .section {

            margin-bottom: 40px;

        }

        .section-title {

            font-size: 24px;

            color: #4f46e5;

            margin-bottom: 20px;

            border-left:
            6px solid #7c3aed;

            padding-left: 15px;

        }

        .section p {

            line-height: 1.8;

            color: #374151;

        }

        /* SKILLS */

        .skills {

            display: flex;
            flex-wrap: wrap;
            gap: 12px;

        }

        .skill {

            background:
            linear-gradient(
                90deg,
                #eef2ff,
                #ede9fe
            );

            color: #4338ca;

            padding: 10px 18px;

            border-radius: 30px;

            font-size: 14px;

            font-weight: bold;

        }

        /* PROJECTS */

        .project-card {

            border:
            1px solid #e5e7eb;

            border-radius: 16px;

            padding: 20px;

            margin-bottom: 20px;

            transition: 0.3s;

            background: #fafafa;

        }

        .project-card h3 {

            margin-top: 0;

            color: #111827;

        }

        .project-card p {

            margin: 10px 0;

        }

        .project-meta {

            margin-top: 10px;

            color: #6b7280;

            font-size: 14px;

        }

        .footer {

            background: #111827;

            color: white;

            text-align: center;

            padding: 18px;

            font-size: 14px;

        }

    </style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="profile-circle">

            @if(!empty($user->image))

                @if($profileImage)

                    <img
                        src="{{ $profileImage }}"
                        class="profile-img"
                    >

                @endif

            @endif

        </div>

        <div class="header-content">

            <h1>
                {{ $user->name }}
            </h1>

            <p>
                📧 {{ $user->email }}
            </p>

            <p>
                🎓 GPA:
                {{ $user->gpa }}
            </p>

            <p>
                🎯 {{ $user->interests }}
            </p>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- EDUCATION -->
        <div class="section">

            <div class="section-title">

                🎓 Education

            </div>

            <p>
                {{ $user->education }}
            </p>

        </div>

        <!-- EXPERIENCE -->
        <div class="section">

            <div class="section-title">

                💼 Experience

            </div>

            <p>
                {{ $user->experience }}
            </p>

        </div>

        <!-- SKILLS -->
        <div class="section">

            <div class="section-title">

                💡 Skills

            </div>

            <div class="skills">

                @foreach($skills as $skill)

                    <div class="skill">

                        {{ trim($skill) }}

                    </div>

                @endforeach

            </div>

        </div>

        <!-- PROJECTS -->
        <div class="section">

            <div class="section-title">

                🚀 Projects

            </div>

            @if(is_array($projects) || is_object($projects))

                @foreach($projects as $project)

                    <div class="project-card">

                        <h3>

                            {{ $project->title ?? 'Project' }}

                        </h3>

                        <p>

                            {{ $project->desc ?? '' }}

                        </p>

                        <div class="project-meta">

                            ⭐ Rating:
                            {{ $project->rating ?? 0 }}

                            &nbsp;&nbsp;

                            👁 Views:
                            {{ $project->views ?? 0 }}

                        </div>

                    </div>

                @endforeach

            @endif

        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">

        CareerForge Professional Resume

    </div>

</div>

</body>
</html>