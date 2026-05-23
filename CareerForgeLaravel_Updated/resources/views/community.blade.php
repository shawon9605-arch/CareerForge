<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        CareerForge Community
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

        <a href="/community"
           class="active">

            🌍 Community

        </a>

        <a href="/quizzes">

            📚 Assessments

        </a>
        <a href="/performance">

               📈 Performance

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

                    🌍 Community Hub

                </h1>

                <p style="opacity:0.7; margin-top:-10px;">

                    Connect, share knowledge & grow together

                </p>

            </div>

            <div class="profile">

                <img
                    src="{{ asset($user->image ?? 'assets/user.png') }}"
                    class="topbar-profile-img"
                >

                <div>

                    <strong>

                        {{ $user->name ?? 'Student' }}

                    </strong>

                    <p style="opacity:0.6; font-size:13px; margin-top:4px;">

                        CareerForge User

                    </p>

                </div>

            </div>

        </div>

        <!-- CREATE POST -->

        <div class="card"
             style="margin-bottom:30px;">

            <h2 style="margin-bottom:25px;">

                ✍ Create New Post

            </h2>

            <form>

                <textarea
                    placeholder="Share your ideas, achievements or ask questions..."
                    style="margin-bottom:20px;"
                ></textarea>

                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    gap:20px;
                    flex-wrap:wrap;
                ">

                    <div class="tags">

                        <span>
                            🚀 Career
                        </span>

                        <span>
                            💻 Tech
                        </span>

                        <span>
                            📚 Learning
                        </span>

                    </div>

                    <button type="button">

                        Post Now

                    </button>

                </div>

            </form>

        </div>

        <!-- COMMUNITY POSTS -->

        <div style="
            display:flex;
            flex-direction:column;
            gap:25px;
        ">

            <!-- POST 1 -->

            <div class="card">

                <!-- POST HEADER -->

                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin-bottom:20px;
                ">

                    <div style="
                        display:flex;
                        align-items:center;
                        gap:15px;
                    ">

                        <img
                            src="{{ asset($user->image ?? 'assets/user.png') }}"
                            style="
                                width:55px;
                                height:55px;
                                border-radius:50%;
                                object-fit:cover;
                            "
                        >

                        <div>

                            <h3>

                                Imran Iqbal

                            </h3>

                            <p style="
                                opacity:0.6;
                                font-size:13px;
                                margin-top:4px;
                            ">

                                2 hours ago

                            </p>

                        </div>

                    </div>

                    <div class="match">

                        🔥 Trending

                    </div>

                </div>

                <!-- POST CONTENT -->

                <p style="
                    opacity:0.82;
                    line-height:1.9;
                    margin-bottom:25px;
                ">

                    Just completed my CareerForge portfolio setup 🚀
                    Really loving the modern dashboard and assessment system!

                </p>

                <!-- POST IMAGE -->

                <div style="
                    width:100%;
                    height:260px;
                    border-radius:24px;
                    background:
                    linear-gradient(
                        135deg,
                        #4f46e5,
                        #7c3aed
                    );
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    font-size:70px;
                    margin-bottom:25px;
                ">

                    🌌

                </div>

                <!-- ACTIONS -->

                <div style="
                    display:flex;
                    gap:15px;
                    flex-wrap:wrap;
                ">

                    <button>

                        ❤️ Like

                    </button>

                    <button>

                        💬 Comment

                    </button>

                    <button>

                        🔄 Share

                    </button>

                </div>

            </div>

            <!-- POST 2 -->

            <div class="card">

                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin-bottom:20px;
                ">

                    <div style="
                        display:flex;
                        align-items:center;
                        gap:15px;
                    ">

                        <div style="
                            width:55px;
                            height:55px;
                            border-radius:50%;
                            background:
                            linear-gradient(
                                135deg,
                                #06b6d4,
                                #3b82f6
                            );
                            display:flex;
                            justify-content:center;
                            align-items:center;
                            font-size:22px;
                        ">

                            👨‍💻

                        </div>

                        <div>

                            <h3>

                                Sarah Ahmed

                            </h3>

                            <p style="
                                opacity:0.6;
                                font-size:13px;
                                margin-top:4px;
                            ">

                                5 hours ago

                            </p>

                        </div>

                    </div>

                    <div class="match">

                        💡 Helpful

                    </div>

                </div>

                <p style="
                    opacity:0.82;
                    line-height:1.9;
                    margin-bottom:25px;
                ">

                    Anyone preparing for frontend interviews?
                    Let's create a discussion group for React & JavaScript interview prep!

                </p>

                <div class="tags">

                    <span>
                        React
                    </span>

                    <span>
                        JavaScript
                    </span>

                    <span>
                        Interview
                    </span>

                </div>

                <br>

                <div style="
                    display:flex;
                    gap:15px;
                    flex-wrap:wrap;
                ">

                    <button>

                        ❤️ Like

                    </button>

                    <button>

                        💬 Comment

                    </button>

                    <button>

                        🔄 Share

                    </button>

                </div>

            </div>

            <!-- POST 3 -->

            <div class="card">

                <div style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin-bottom:20px;
                ">

                    <div style="
                        display:flex;
                        align-items:center;
                        gap:15px;
                    ">

                        <div style="
                            width:55px;
                            height:55px;
                            border-radius:50%;
                            background:
                            linear-gradient(
                                135deg,
                                #f59e0b,
                                #ef4444
                            );
                            display:flex;
                            justify-content:center;
                            align-items:center;
                            font-size:22px;
                        ">

                            🧠

                        </div>

                        <div>

                            <h3>

                                AI Research Group

                            </h3>

                            <p style="
                                opacity:0.6;
                                font-size:13px;
                                margin-top:4px;
                            ">

                                1 day ago

                            </p>

                        </div>

                    </div>

                    <div class="match">

                        🤖 AI

                    </div>

                </div>

                <p style="
                    opacity:0.82;
                    line-height:1.9;
                    margin-bottom:25px;
                ">

                    New AI workshop launching next week!
                    Topics include Machine Learning, Deep Learning & Prompt Engineering.

                </p>

                <div class="tags">

                    <span>
                        AI
                    </span>

                    <span>
                        Machine Learning
                    </span>

                    <span>
                        Workshop
                    </span>

                </div>

                <br>

                <div style="
                    display:flex;
                    gap:15px;
                    flex-wrap:wrap;
                ">

                    <button>

                        ❤️ Like

                    </button>

                    <button>

                        💬 Comment

                    </button>

                    <button>

                        🔄 Share

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
