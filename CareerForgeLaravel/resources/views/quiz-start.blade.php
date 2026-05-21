<!DOCTYPE html>
<html>

<head>

    <title>{{ $quiz->title }}</title>

    <link rel="stylesheet"
          href="{{ asset('assets/style.css') }}">

</head>

<body>

<div class="main">

    <h1>
        {{ $quiz->title }}
    </h1>

    <h3 id="timer"
        data-duration="{{ $quiz->duration }}">

        ⏱ Time Left:
        {{ $quiz->duration }}:00

    </h3>

    <form
        method="POST"
        action="{{ url('/quiz/submit/' . $quiz->id) }}"
        id="quizForm"
    >

        @csrf

        @foreach($questions as $question)

            <div class="card">

                <h3>
                    {{ $question->question }}
                </h3>

                <label>

                    <input
                        type="radio"
                        name="question_{{ $question->id }}"
                        value="a"
                    >

                    {{ $question->option_a }}

                </label>

                <br>

                <label>

                    <input
                        type="radio"
                        name="question_{{ $question->id }}"
                        value="b"
                    >

                    {{ $question->option_b }}

                </label>

                <br>

                <label>

                    <input
                        type="radio"
                        name="question_{{ $question->id }}"
                        value="c"
                    >

                    {{ $question->option_c }}

                </label>

                <br>

                <label>

                    <input
                        type="radio"
                        name="question_{{ $question->id }}"
                        value="d"
                    >

                    {{ $question->option_d }}

                </label>

            </div>

        @endforeach

        <button type="submit">

            Submit Quiz

        </button>

    </form>

</div>

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

    timer.innerHTML =
    "⏱ Time Left: " +
    minutes + ":" + seconds;

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