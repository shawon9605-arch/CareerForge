<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Quiz Result
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

        <a href="/quizzes"
           class="active">

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

                    🏆 Quiz Result

                </h1>

                <p style="opacity:0.7; margin-top:-10px;">

                    Review your assessment performance & improvement areas

                </p>

            </div>

        </div>

        <!-- RESULT STATS -->

        <div class="stats"
             style="margin-bottom:35px;">

            <div class="stat-card">

                <h3>

                    {{ $score }}

                </h3>

                <p>

                    Final Score

                </p>

            </div>

            <div class="stat-card">

                <h3>

                    {{ $correct }}

                </h3>

                <p>

                    Correct Answers

                </p>

            </div>

            <div class="stat-card">

                <h3>

                    {{ $wrong }}

                </h3>

                <p>

                    Wrong Answers

                </p>

            </div>

        </div>

        <!-- PERFORMANCE -->

        <div class="card"
             style="margin-bottom:35px;">

            <div class="section-header">

                <h2>

                    📊 Performance Analysis

                </h2>

                <div class="match">

                    @php

                        $percentage =
                        ($correct + $wrong) > 0
                        ? round(($correct / ($correct + $wrong)) * 100)
                        : 0;

                    @endphp

                    {{ $percentage }}%
                    Accuracy

                </div>

            </div>

            <!-- PROGRESS BAR -->

            <div style="
                width:100%;
                height:18px;
                background:rgba(255,255,255,0.08);
                border-radius:30px;
                overflow:hidden;
                margin-top:25px;
            ">

                <div
                    class="progress-fill"
                    data-width="{{ $percentage }}"
                >
                </div>

            </div>

            <p style="
                margin-top:18px;
                opacity:0.7;
                line-height:1.8;
            ">

                You answered
                {{ $percentage }}%
                questions correctly.
                Keep practicing to improve your performance 🚀

            </p>

        </div>

        <!-- MISTAKES -->

        <div class="card">

            <div class="section-header">

                <h2>

                    📉 Mistake Analysis

                </h2>

                <div class="match">

                    {{ count($mistakes) }}
                    Mistakes

                </div>

            </div>

            @if(count($mistakes) > 0)

                <div style="
                    display:flex;
                    flex-direction:column;
                    gap:25px;
                    margin-top:25px;
                ">

                    @foreach($mistakes as $mistake)

                        <div style="
                            background:
                            rgba(255,255,255,0.04);

                            border:
                            1px solid rgba(255,255,255,0.08);

                            border-radius:24px;

                            padding:28px;
                        ">

                            <!-- QUESTION -->

                            <h3 style="
                                margin-bottom:20px;
                                line-height:1.7;
                            ">

                                ❓ {{ $mistake['question'] }}

                            </h3>

                            <!-- ANSWERS -->

                            <div style="
                                display:grid;
                                grid-template-columns:
                                repeat(auto-fit,minmax(250px,1fr));

                                gap:20px;

                                margin-bottom:25px;
                            ">

                                <!-- USER ANSWER -->

                                <div style="
                                    background:
                                    rgba(239,68,68,0.12);

                                    border:
                                    1px solid rgba(239,68,68,0.2);

                                    padding:20px;

                                    border-radius:20px;
                                ">

                                    <p style="
                                        opacity:0.7;
                                        margin-bottom:10px;
                                    ">

                                        ❌ Your Answer

                                    </p>

                                    <h2>

                                        {{
                                            strtoupper(
                                                $mistake['your_answer']
                                            )
                                        }}

                                    </h2>

                                </div>

                                <!-- CORRECT ANSWER -->

                                <div style="
                                    background:
                                    rgba(16,185,129,0.12);

                                    border:
                                    1px solid rgba(16,185,129,0.2);

                                    padding:20px;

                                    border-radius:20px;
                                ">

                                    <p style="
                                        opacity:0.7;
                                        margin-bottom:10px;
                                    ">

                                        ✅ Correct Answer

                                    </p>

                                    <h2>

                                        {{
                                            strtoupper(
                                                $mistake['correct_answer']
                                            )
                                        }}

                                    </h2>

                                </div>

                            </div>

                            <!-- EXPLANATION -->

                            <div style="
                                background:
                                rgba(255,255,255,0.04);

                                border-radius:20px;

                                padding:22px;

                                line-height:1.9;

                                opacity:0.82;
                            ">

                                💡
                                {{ $mistake['explanation'] }}

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <!-- PERFECT SCORE -->

                <div style="
                    text-align:center;
                    padding:60px 20px;
                ">

                    <div style="
                        font-size:90px;
                        margin-bottom:20px;
                    ">

                        🎉

                    </div>

                    <h2 style="
                        margin-bottom:15px;
                    ">

                        Perfect Performance!

                    </h2>

                    <p style="
                        opacity:0.7;
                        line-height:1.8;
                    ">

                        Amazing job! You answered all questions correctly.

                    </p>

                </div>

            @endif

        </div>

        <!-- ACTION BUTTONS -->

        <div style="
            display:flex;
            gap:20px;
            margin-top:35px;
            flex-wrap:wrap;
        ">

            <a href="/quizzes"
               class="btn">

                📚 Back To Quizzes

            </a>

            <a href="/"
               class="btn">

                🏠 Dashboard

            </a>

        </div>

    </div>

</div>

<script>

document
.querySelectorAll('.progress-fill')
.forEach((bar) => {

    let width =
    bar.getAttribute(
        'data-width'
    );

    bar.style.width =
    width + '%';

});

</script>

</body>

</html>