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

</head>

<body>

@if(session('success'))

<div id="successMessage"
     style="
        position:fixed;
        top:30px;
        right:30px;
        background:linear-gradient(90deg,#10b981,#059669);
        color:white;
        padding:18px 28px;
        border-radius:18px;
        z-index:99999;
        font-weight:600;
     ">

    ✅ {{ session('success') }}

</div>

@endif

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

        <a href="/resource-recommendation">

    📖 Resources

    </a>

        <a href="/quizzes">

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

        <!-- TOP -->

        <div class="topbar">

            <div>

                <h1 class="page-title">

                    🌍 Community Hub

                </h1>

                <p style="opacity:0.7; margin-top:-10px;">

                    Connect, share and engage with others

                </p>

            </div>

            <!-- PROFILE -->

            <div class="profile">

                <img
                    src="{{ asset($user->image ?? 'assets/user.png') }}"
                    class="topbar-profile-img"
                >

                <div>

                    <strong>

                        {{ $user->name ?? 'Student' }}

                    </strong>

                    <p style="
                        opacity:0.6;
                        font-size:13px;
                        margin-top:4px;
                    ">

                        CareerForge User

                    </p>

                </div>

            </div>

        </div>

        <!-- CREATE POST -->

        <div class="card"
             style="margin-bottom:35px;">

            <h2 style="margin-bottom:25px;">

                ✍ Create New Post

            </h2>

            <form
                method="POST"
                action="/community/post"
            >

                @csrf

                <textarea
                    name="content"
                    placeholder="Share something with the community..."
                    required
                ></textarea>

                <br><br>

                <button
                    type="submit"
                    style="width:100%;">

                    🚀 Post Now

                </button>

            </form>

        </div>

        <!-- POSTS -->

        <div style="
            display:flex;
            flex-direction:column;
            gap:25px;
        ">

            @foreach($posts as $post)

                <div class="card">

                    <!-- USER -->

                    <div style="
                        display:flex;
                        align-items:center;
                        gap:15px;
                        margin-bottom:20px;
                    ">

                        <img
                            src="{{ asset($post->image ?? 'assets/user.png') }}"
                            style="
                                width:60px;
                                height:60px;
                                border-radius:50%;
                                object-fit:cover;
                            "
                        >

                        <div>

                            <h3>

                                {{ $post->name }}

                            </h3>

                            <p style="
                                opacity:0.6;
                                font-size:13px;
                            ">

                                {{ $post->created_at }}

                            </p>

                        </div>

                    </div>

                    <!-- CONTENT -->

                    <p style="
                        line-height:1.9;
                        opacity:0.8;
                        margin-bottom:25px;
                    ">

                        {{ $post->content }}

                    </p>

                    <!-- ACTIONS -->

                    <div style="
                        display:flex;
                        gap:15px;
                        flex-wrap:wrap;
                    ">

                        <a href="/community/like/{{ $post->id }}">

                            <button>

                                ❤️ Like
                                ({{ $post->likes }})

                            </button>

                        </a>

                        <a href="/community/comment/{{ $post->id }}">

                            <button>

                                💬 Comment
                                ({{ $post->comments }})

                            </button>

                        </a>

                        <a href="/community/share/{{ $post->id }}">

                            <button>

                                🔄 Share
                                ({{ $post->shares }})

                            </button>

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

<script>

setTimeout(() => {

    let success =
    document.getElementById(
        'successMessage'
    );

    if(success) {

        success.style.display =
        'none';

    }

}, 3000);

</script>

</body>

</html>
