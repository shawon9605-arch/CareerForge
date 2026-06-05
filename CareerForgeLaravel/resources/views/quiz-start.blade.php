<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        {{ $quiz->title }}
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

        <a href="/resource-recommendation">

    📖 Resources

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

                    🧠 {{ $quiz->title }}

                </h1>

                <p style="opacity:0.7; margin-top:-10px;">

                    Complete the assessment before time runs out

                </p>

            </div>

            <!-- TIMER -->

            <div class="card"
                 style="
                    padding:18px 24px;
                    border-radius:22px;
                    min-width:220px;
                    text-align:center;
                 ">

                <h3 id="timer"
                    data-duration="{{ $quiz->duration }}"
                    style="
                        font-size:28px;
                        margin-bottom:6px;
                    ">

                    ⏱ {{ $quiz->duration }}:00

                </h3>

                <p style="opacity:0.65;">

                    Time Remaining

                </p>

            </div>

        </div>

        <!-- QUIZ FORM -->

        <form
            method="POST"
            action="{{ url('/quiz/submit/' . $quiz->id) }}"
            id="quizForm"
        >

            @csrf

            @foreach($questions as $index => $question)

                <div class="card"
                     style="margin-bottom:30px;">

                    <!-- QUESTION -->

                    <div style="
                        display:flex;
                        align-items:center;
                        gap:15px;
                        margin-bottom:25px;
                    ">

                        <div style="
                            width:45px;
                            height:45px;
                            border-radius:14px;
                            background:
                            linear-gradient(
                                135deg,
                                #4f46e5,
                                #7c3aed
                            );
                            display:flex;
                            justify-content:center;
                            align-items:center;
                            font-weight:700;
                        ">

                            {{ $index + 1 }}

                        </div>

                        <h2 style="font-size:24px;">

                            {{ $question->question }}

                        </h2>

                    </div>

                    <!-- OPTIONS -->

                    <div style="
                        display:flex;
                        flex-direction:column;
                        gap:18px;
                    ">

                        <!-- OPTION A -->

                        <label class="quiz-option">

                            <input
                                type="radio"
                                name="question_{{ $question->id }}"
                                value="a"
                            >

                            <span>

                                {{ $question->option_a }}

                            </span>

                        </label>

                        <!-- OPTION B -->

                        <label class="quiz-option">

                            <input
                                type="radio"
                                name="question_{{ $question->id }}"
                                value="b"
                            >

                            <span>

                                {{ $question->option_b }}

                            </span>

                        </label>

                        <!-- OPTION C -->

                        <label class="quiz-option">

                            <input
                                type="radio"
                                name="question_{{ $question->id }}"
                                value="c"
                            >

                            <span>

                                {{ $question->option_c }}

                            </span>

                        </label>

                        <!-- OPTION D -->

                        <label class="quiz-option">

                            <input
                                type="radio"
                                name="question_{{ $question->id }}"
                                value="d"
                            >

                            <span>

                                {{ $question->option_d }}

                            </span>

                        </label>

                    </div>

                </div>

            @endforeach

            <!-- SUBMIT -->

            <button
                type="submit"
                style="
                    width:100%;
                    padding:18px;
                    font-size:18px;
                    border-radius:20px;
                ">

                🚀 Submit Quiz

            </button>

        </form>

    </div>

</div>

<!-- QUIZ OPTION STYLE -->

<style>

.quiz-option {

    display: flex;

    align-items: center;

    gap: 15px;

    padding: 20px;

    border-radius: 18px;

    background:
    rgba(255,255,255,0.05);

    border:
    1px solid rgba(255,255,255,0.08);

    cursor: pointer;

    transition: 0.3s ease;

}

.quiz-option:hover {

    transform: translateY(-2px);

    background:
    rgba(255,255,255,0.08);

}

.quiz-option input[type="radio"] {

    width: 20px;

    height: 20px;

    accent-color: #7c3aed;

}

.quiz-option span {

    font-size: 16px;

    line-height: 1.7;

}

</style>

<!-- TIMER SCRIPT -->

<script>

let timer =
document.getElementById("timer");

let time =
parseInt(timer.dataset.duration) * 60;

setInterval(function () {

    let minutes =
    Math.floor(time / 60);

    let seconds =
    time % 60;

    seconds =
    seconds < 10
    ? "0" + seconds
    : seconds;

    timer.innerHTML =
    "⏱ " +
    minutes +
    ":" +
    seconds;

    time--;

    if (time < 0) {

        document
        .getElementById("quizForm")
        .submit();

    }

}, 1000);

</script>

</body>

</html>
