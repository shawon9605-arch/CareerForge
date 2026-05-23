<!DOCTYPE html>
<html>

<head>

    <title>CareerForge Quizzes</title>

    <link rel="stylesheet"
          href="{{ asset('assets/style.css') }}">

    <style>

    body {

        margin: 0;
        font-family: Arial, sans-serif;
        background:
        linear-gradient(
            90deg,
            #0f172a,
            #1e1b4b
        );

        color: white;

    }

    .main {

        padding: 40px;

    }

    .main h1 {

        margin-bottom: 30px;
        font-size: 42px;

    }

    .quiz-controls {

        display: flex;
        gap: 15px;
        margin-bottom: 35px;
        flex-wrap: wrap;

    }

    .quiz-controls input,
    .quiz-controls select {

        padding: 14px 18px;

        border-radius: 14px;

        border:
        1px solid rgba(255,255,255,0.15);

        background:
        rgba(255,255,255,0.08);

        backdrop-filter: blur(12px);

        color: white;

        font-size: 15px;

        font-weight: 500;

        width: 220px;

        cursor: pointer;

        outline: none;

        transition: 0.3s ease;

    }

    .quiz-controls select:hover {

        border-color:
        rgba(255,255,255,0.35);

    }

    .quiz-controls select:focus {

        border-color: #7c3aed;

        box-shadow:
        0 0 0 4px rgba(124,58,237,0.2);

    }

.quiz-controls select:hover {

    border-color:
    rgba(255,255,255,0.35);

}

.quiz-controls select:focus {

    border-color: #7c3aed;

    box-shadow:
    0 0 0 4px rgba(124,58,237,0.2);

}

    .quiz-controls input {

        width: 260px;

    }

    .quiz-controls select {

        width: 200px;

    }

    .quiz-controls option {

        background: #111827;

        color: white;

    }

    .quiz-grid {

        display: grid;

        grid-template-columns:
        repeat(auto-fit, minmax(320px, 1fr));

        gap: 25px;

    }

    .quiz-card {

        background:
        rgba(255,255,255,0.08);

        border:
        1px solid rgba(255,255,255,0.1);

        backdrop-filter: blur(10px);

        border-radius: 22px;

        padding: 28px;

        transition: 0.3s ease;

        box-shadow:
        0 10px 25px rgba(0,0,0,0.25);

    }

    .quiz-card:hover {

        transform: translateY(-5px);

        box-shadow:
        0 15px 35px rgba(0,0,0,0.35);

    }

    .quiz-top {

        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-bottom: 18px;

    }

    .quiz-top h2 {

        margin: 0;
        font-size: 24px;
        color: white;

    }

    .difficulty {

        padding: 6px 14px;

        border-radius: 30px;

        font-size: 12px;

        font-weight: bold;

        background: #4f46e5;

        color: white;

    }

    .quiz-card p {

        color: rgba(255,255,255,0.75);

        line-height: 1.6;

        min-height: 60px;

    }

    .quiz-meta {

        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-top: 25px;
        margin-bottom: 25px;

        color: rgba(255,255,255,0.85);

        font-size: 14px;

    }

    .quiz-card button {

        width: 100%;

        padding: 14px;

        border: none;

        border-radius: 14px;

        background:
        linear-gradient(
            90deg,
            #4f46e5,
            #7c3aed
        );

        color: white;

        font-size: 15px;

        font-weight: bold;

        cursor: pointer;

        transition: 0.3s;

    }

    .quiz-card button:hover {

        opacity: 0.9;
        transform: scale(1.02);

    }

    </style>

</head>

<body>

<div class="dashboard">

    <!-- SIDEBAR -->
     <div class="sidebar">

        <h2>
            🔥 CareerForge
        </h2>

        <a href="/"
        class="{{ request()->is('/') ? 'active' : '' }}">

            🏠 Dashboard

        </a>

        <a href="/profile"
        class="{{ request()->is('profile') ? 'active' : '' }}">

            👤 Profile

        </a>

        <a href="/jobs"
        class="{{ request()->is('jobs') ? 'active' : '' }}">

            💼 Jobs

        </a>

        <a href="/community"
        class="{{ request()->is('community') ? 'active' : '' }}">

            🌍 Community

        </a>

        <a href="/quizzes"
        class="{{ request()->is('quizzes') ? 'active' : '' }}">

            📚 Assessments

        </a>

        <a href="/events"
        class="{{ request()->is('events') ? 'active' : '' }}">

            📅 Calendar

        </a>

        <a href="/logout"
        class="logout-btn">

            🚪 Logout

        </a>

    </div>

    <!-- MAIN -->
    <div class="main">

        <h1>📚 Assessment & Quiz System</h1>

        <!-- SEARCH + FILTER -->
        <div class="quiz-controls">

            <!-- SEARCH -->
            <input
                type="text"
                id="searchInput"
                placeholder="🔍 Search quizzes..."
            >

            <!-- CATEGORY -->
            <select id="categoryFilter">

                <option value="all">
                    All Categories
                </option>

                <option value="Python">
                    Python
                </option>

                <option value="Frontend">
                    Frontend
                </option>

                <option value="Backend">
                    Backend
                </option>

                <option value="Database">
                    Database
                </option>

                <option value="Cybersecurity">
                    Cybersecurity
                </option>

                <option value="React">
                    React
                </option>

            </select>

        </div>

        <!-- QUIZ GRID -->
        <div class="quiz-grid"
             id="quizContainer">

            @foreach($quizzes as $quiz)

                <div class="quiz-card"
                     data-category="{{ $quiz->category }}">

                    <div class="quiz-top">

                        <h2>
                            {{ $quiz->title }}
                        </h2>

                        <span class="difficulty">

                            {{ $quiz->difficulty }}

                        </span>

                    </div>

                    <p class="quiz-description">
                        {{ $quiz->description }}
                    </p>

                    <div class="quiz-meta">

                        <span>
                            📚 {{ $quiz->category }}
                        </span>

                        <span>
                            ⏱ {{ $quiz->duration }} mins
                        </span>

                    </div>

                    <a href="{{ url('/quiz/' . $quiz->id) }}">

                        <button>

                            Start Quiz

                        </button>

                    </a>

                </div>

            @endforeach

        </div>

    </div>

</div>

<!-- ====================== -->
<!-- FILTER JS -->
<!-- ====================== -->

<script>

const searchInput =
document.getElementById("searchInput");

const categoryFilter =
document.getElementById("categoryFilter");

const quizCards =
document.querySelectorAll(".quiz-card");

function filterQuizzes() {

    let search =
    searchInput.value.toLowerCase();

    let category =
    categoryFilter.value;

    quizCards.forEach((card) => {

        let text =
        card.innerText.toLowerCase();

        let cardCategory =
        card.dataset.category;

        let matchesSearch =
        text.includes(search);

        let matchesCategory =

            category === "all" ||

            cardCategory === category;

        if (
            matchesSearch &&
            matchesCategory
        ) {

            card.style.display = "block";

        } else {

            card.style.display = "none";

        }

    });

}

searchInput
.addEventListener(
    "keyup",
    filterQuizzes
);

categoryFilter
.addEventListener(
    "change",
    filterQuizzes
);

</script>

</body>
</html>