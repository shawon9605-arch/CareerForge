<?php
include('../config/db.php');
session_start();

$email = $_SESSION['email'];
$user = $conn->query("SELECT * FROM students WHERE email='$email'")->fetch_assoc();
?>

<link rel="stylesheet" href="../assets/style.css">
<style>
    .feed {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.post-card {
    background: rgba(255,255,255,0.08);
    padding: 20px;
    border-radius: 16px;
    backdrop-filter: blur(10px);
}

.comments {
    margin-top: 10px;
    font-size: 14px;
    color: #ccc;
}

.right-panel {
    width: 250px;
    padding: 20px;
}

.mentor-card {
    background: rgba(255,255,255,0.08);
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 10px;
    text-align: center;
}
</style>

<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>🔥 CareerForge</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="profile.php">Profile</a>
        <a href="jobs.php">Jobs</a>
        <a href="community.php">Community</a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <h1>💬 Community</h1>

        <!-- CREATE POST -->
        <div class="card">
            <form method="POST" action="post.php">
                <textarea name="content" placeholder="Share your thoughts..."></textarea>
                <button type="submit">Post</button>
            </form>
        </div>

        <!-- POSTS -->
        <div class="feed">

            <!-- SAMPLE POST -->
            <div class="post-card">
                <h4>Imran Hossain</h4>
                <p>Just cleared my frontend interview! 🎉</p>

                <div class="comments">
                    <p><strong>Rahim:</strong> Congrats! 🔥</p>
                </div>

                <form method="POST" action="comment.php">
                    <input type="text" name="comment" placeholder="Write a comment...">
                    <button type="submit">Comment</button>
                </form>
            </div>

        </div>

    </div>

    <!-- RIGHT PANEL (MENTORS) -->
    <div class="right-panel">

        <h3>👨‍🏫 Mentors</h3>

        <div class="mentor-card">
            <p><strong>John Doe</strong></p>
            <p>Frontend Developer</p>
            <button>Connect</button>
        </div>

        <div class="mentor-card">
            <p><strong>Jane Smith</strong></p>
            <p>Backend Engineer</p>
            <button>Connect</button>
        </div>

    </div>

</div>