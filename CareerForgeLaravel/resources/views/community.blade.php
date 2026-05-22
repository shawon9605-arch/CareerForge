<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>CareerForge Community</title>

    <link rel="stylesheet"
          href="{{ asset('assets/style.css') }}">

</head>

<body>

<div class="dashboard">
    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2>🔥 CareerForge</h2>

        <a href="{{ url('/') }}">
            Dashboard
        </a>

        <a href="{{ url('/profile') }}">
            Profile
        </a>

        <a href="{{ url('/jobs') }}">
            Jobs
        </a>

        <a href="{{ url('/community') }}">
            Community
        </a>

        <a href="{{ url('/quizzes') }}">
            Quizzes
        </a>
            <a href="/logout"
             class="logout-btn">

                🚪 Logout
            </a>

    </div>

    <!-- MAIN -->
    <div class="main">

        <h1>🌐 Community Feed</h1>

        <!-- CREATE POST -->
        <div class="card">

            <h3>Create Post</h3>

            <textarea
                id="postInput"
                placeholder="Share something..."
            ></textarea>

            <button onclick="addPost()">
                Post
            </button>

        </div>

        <!-- POSTS -->
        <div id="postContainer">

            @foreach($posts as $post)

                <div class="card post-card">

                    <div class="post-top">

                        <h3>
                            {{ $post['name'] }}
                        </h3>

                        <span>
                            {{ $post['role'] }}
                        </span>

                    </div>

                    <p class="post-content">

                        {{ $post['content'] }}

                    </p>

                    <!-- ACTIONS -->
                    <div class="post-actions">

                        <button onclick="likePost(this)">
                            ❤️ {{ $post['likes'] }}
                        </button>

                    </div>

                    <!-- COMMENTS -->
                    <div class="comment-section">

                        @foreach($post['comments'] as $comment)

                            <div class="comment">

                                💬 {{ $comment }}

                            </div>

                        @endforeach

                        <div class="comment-input">

                            <input
                                type="text"
                                placeholder="Write comment..."
                            >

                            <button
                                onclick="addComment(this)"
                            >
                                Comment
                            </button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

<!-- ====================== -->
<!-- JS -->
<!-- ====================== -->

<script>

function addPost() {

    let input =
    document.getElementById("postInput");

    let value =
    input.value.trim();

    if (!value) return;

    let container =
    document.getElementById("postContainer");

    let card =
    document.createElement("div");

    card.className =
    "card post-card";

    card.innerHTML = `

        <div class="post-top">

            <h3>You</h3>

            <span>Student</span>

        </div>

        <p class="post-content">
            ${value}
        </p>

        <div class="post-actions">

            <button onclick="likePost(this)">
                ❤️ 0
            </button>

        </div>

        <div class="comment-section">

            <div class="comment-input">

                <input
                    type="text"
                    placeholder="Write comment..."
                >

                <button
                    onclick="addComment(this)"
                >
                    Comment
                </button>

            </div>

        </div>

    `;

    container.prepend(card);

    input.value = "";

}

function likePost(btn) {

    let text =
    btn.innerText;

    let count =
    parseInt(text.replace(/\D/g, ''));

    count++;

    btn.innerText =
    `❤️ ${count}`;

}

function addComment(btn) {

    let input =
    btn.previousElementSibling;

    let value =
    input.value.trim();

    if (!value) return;

    let comment =
    document.createElement("div");

    comment.className = "comment";

    comment.innerHTML =
    `💬 ${value}`;

    btn.parentElement.before(comment);

    input.value = "";

}

</script>

</body>
</html>