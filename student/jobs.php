<?php
include('../config/db.php');

/* START SESSION */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* LOGIN CHECK */
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

/* FETCH USER */
$result = $conn->query("SELECT skills FROM students WHERE email='$email'");
$user = $result->fetch_assoc();

/* SAFE SKILLS */
$userSkills = [];
if (!empty($user['skills'])) {
    $userSkills = explode(',', strtolower($user['skills']));
}
?>
<link rel="stylesheet" href="../assets/style.css">

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

        <h1>💼 Job Recommendations</h1>

        <!-- SEARCH BAR -->
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="🔍 Search jobs...">
        </div>

        <!-- JOB LIST -->
        <div class="job-list">

            <!-- JOB CARD 1 -->
            <div class="job-card">

                <!-- TOP -->
                <div class="job-top">
                    <h3>Frontend Developer</h3>
                    <?php
                    $jobSkills = ['html','css','javascript'];

                    $matchCount = count(array_intersect($userSkills, $jobSkills));
                    $total = count($jobSkills);

                    $matchPercent = ($total > 0) ? ($matchCount / $total) * 100 : 0;
                    ?>
                    <span class="match"><?php echo round($matchPercent); ?>%</span>
                </div>

                <!-- COMPANY -->
                <p class="company">Tech Solutions Ltd.</p>

                <!-- SKILLS -->
                <div class="tags">
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>JavaScript</span>
                </div>

                <!-- BOTTOM -->
                <div class="job-bottom">
                    <span class="location">📍 Remote</span>
                    <button>Apply</button>
                </div>

            </div>

            <!-- JOB CARD 2 -->
            <div class="job-card">
                <div class="job-header">
                    <h3>Backend Developer</h3>
                    <?php
                    $jobSkills = ['php','mysql','api'];

                    $matchCount = count(array_intersect($userSkills, $jobSkills));
                    $total = count($jobSkills);

                    $matchPercent = ($total > 0) ? ($matchCount / $total) * 100 : 0;
                    ?>
                    <span class="match"><?php echo round($matchPercent); ?>%</span>
                </div>

                <p class="company">CodeWorks</p>

                <div class="tags">
                    <span>PHP</span>
                    <span>MySQL</span>
                    <span>API</span>
                </div>

                <div class="job-footer">
                    <span>📍 Onsite</span>
                    <button>Apply</button>
                </div>
            </div>

            <!-- JOB CARD 3 -->
            <div class="job-card">
                <div class="job-header">
                    <h3>Full Stack Developer</h3>
                    <?php
                    $jobSkills = ['react','node.js','mongodb'];

                    $matchCount = count(array_intersect($userSkills, $jobSkills));
                    $total = count($jobSkills);

                    $matchPercent = ($total > 0) ? ($matchCount / $total) * 100 : 0;
                    ?>
                    <span class="match"><?php echo round($matchPercent); ?>%</span>
                </div>

                <p class="company">InnovateX</p>

                <div class="tags">
                    <span>React</span>
                    <span>Node.js</span>
                    <span>MongoDB</span>
                </div>

                <div class="job-footer">
                    <span>📍 Hybrid</span>
                    <button>Apply</button>
                </div>
            </div>

        </div>

    </div>
</div>


<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let jobs = document.querySelectorAll(".job-card");

    jobs.forEach(function(job) {
        let text = job.innerText.toLowerCase();

        if (text.includes(filter)) {
            job.style.display = "block";
        } else {
            job.style.display = "none";
        }
    });
});
</script>