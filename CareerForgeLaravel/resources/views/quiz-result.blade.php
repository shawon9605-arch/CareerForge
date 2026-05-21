<!DOCTYPE html>
<html>

<head>

    <title>Quiz Result</title>

    <link rel="stylesheet"
          href="{{ asset('assets/style.css') }}">

</head>

<body>

<div class="main">

    <h1>🏆 Quiz Result</h1>

    <div class="card">

        <h2>
            Score:
            {{ $score }}
        </h2>

        <p>
            ✅ Correct:
            {{ $correct }}
        </p>

        <p>
            ❌ Wrong:
            {{ $wrong }}
        </p>

    </div>

    <h2>📉 Mistake Analysis</h2>

    @foreach($mistakes as $mistake)

        <div class="card">

            <h3>
                {{ $mistake['question'] }}
            </h3>

            <p>
                ❌ Your Answer:
                {{ strtoupper($mistake['your_answer']) }}
            </p>

            <p>
                ✅ Correct Answer:
                {{ strtoupper($mistake['correct_answer']) }}
            </p>

            <p>
                💡 Explanation:
                {{ $mistake['explanation'] }}
            </p>

        </div>

    @endforeach

</div>

</body>
</html>