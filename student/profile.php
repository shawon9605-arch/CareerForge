<?php
include('../config/db.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$email = $_SESSION['email'] ?? '';

$result = $conn->query("SELECT * FROM students WHERE email='$email'");
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found. Please login again.");
}

$skills = [];
if (!empty($user['skills'])) {
    $skills = explode(',', $user['skills']);
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

        <h1>👤 My Profile</h1>

        <div class="profile-container">

            <!-- LEFT -->
            <div class="profile-left card">
                <img src="<?php echo $user['image'] ?? '../assets/user.png'; ?>" class="profile-img">

                <h2><?php echo $user['name'] ?? 'Student'; ?></h2>
                <p><?php echo $user['email']; ?></p>

                <button onclick="openCV()">📄 View CV</button>
                <button onclick="downloadCV()">⬇ Download CV</button>
            </div>

            <!-- RIGHT -->
            <div class="profile-right">

                <!-- GPA -->
                <div class="card">
                    <h3>🎓 Academic</h3>
                    <input type="number" id="gpaInput" value="<?php echo $user['gpa']; ?>">
                </div>

                <!-- INTERESTS -->
                <div class="card">
                    <h3>🎯 Interests</h3>
                    <textarea id="interestInput"><?php echo $user['interests']; ?></textarea>
                </div>

                <!-- SKILLS -->
                <div class="card">
                    <h3>💡 Skills</h3>
                    <div class="tags">
                        <?php foreach($skills as $skill): ?>
                            <?php if(trim($skill) != ""): ?>
                                <span class="tag"><?php echo trim($skill); ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- SMART SUGGESTIONS -->
                <div class="card">
                    <h3>💡 Smart Suggestions</h3>

                    <?php
                    $skillsText = strtolower($user['skills'] ?? '');

                    if(strpos($skillsText, 'javascript') === false){
                        echo "<p>👉 Learn JavaScript for frontend roles</p>";
                    }

                    if(strpos($skillsText, 'api') === false){
                        echo "<p>👉 Learn API development for backend roles</p>";
                    }

                    if(strpos($skillsText, 'react') === false){
                        echo "<p>👉 Consider learning React</p>";
                    }

                    if(strpos($skillsText, 'mysql') === false){
                        echo "<p>👉 Improve database skills (MySQL)</p>";
                    }
                    ?>
                </div>

                <button class="save-btn" onclick="saveProfile()">Save Changes</button>

            </div>

        </div>

    </div>
</div>

<!-- JS -->
<script>
function saveProfile() {
    let gpa = document.getElementById("gpaInput").value;
    let interests = document.getElementById("interestInput").value;

    fetch("save_profile.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: `gpa=${gpa}&interests=${interests}`
    }).then(() => {
        alert("Profile updated!");
        location.reload();
    });
}

function downloadCV() {
    window.open("cv.php", "_blank");
}

function openCV() {
    window.open("cv.php", "_blank");
}
</script>