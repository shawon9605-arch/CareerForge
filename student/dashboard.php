<?php
include('../config/db.php');

/* START SESSION SAFELY */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* 🔐 LOGIN CHECK */
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

/* FETCH USER */
$result = $conn->query("SELECT * FROM students WHERE email='$email'");
$user = $result->fetch_assoc();

/* SAFETY CHECK */
if (!$user) {
    die("User not found. Please login again.");
}

/* SAFE SKILLS */
$skills = [];
if (!empty($user['skills'])) {
    $skills = explode(',', $user['skills']);
}
?>

<?php if(isset($_GET['success'])): ?>
    <div class="success-msg">
        ✅ Profile updated successfully!
    </div>
<?php endif; ?>

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

        <!-- TOP BAR -->
        <div class="topbar">
            <h1>Welcome Back 👋</h1>

            <div class="profile">
                <img src="../assets/user.png" alt="profile">
                <span><?php echo $user['name'] ?? 'Student'; ?></span>
            </div>
        </div>

        <!-- STATS -->
        <div class="stats">

            <div class="progress-card">
                <div class="circle">
                    <span>75%</span>
                </div>
                <p>Job Readiness</p>
            </div>

            <div class="stat-card">
                <h3><?php echo count($skills); ?></h3>
                <p>Skills</p>
            </div>

            <div class="stat-card">
                <h3>3</h3>
                <p>Jobs Matched</p>
            </div>

        </div>

        <!-- SKILLS -->
        <div class="card">
            <h3>Your Skills</h3>

            <div class="tags" id="skillsContainer">
                <?php foreach($skills as $skill): ?>
                    <?php if(trim($skill) != ""): ?>
                        <span class="tag">
                            <?php echo trim($skill); ?>
                            <button class="remove-btn" onclick="removeSkill(this)">×</button>
                        </span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="skill-input">
                <input type="text" id="skillInput" placeholder="Add a skill">
                <button onclick="addSkill()">Add</button>
            </div>

            <form method="POST" action="save_profile.php">
                <input type="hidden" name="skills" id="skillsHidden">
                <button type="submit">Save Skills</button>
            </form>
        </div>

        <!-- PROFILE -->
        <div class="card">
            <h3>Update Profile</h3>

            <form method="POST" action="save_profile.php">
                <textarea name="interests" placeholder="🎯 Your Interests"><?php echo $user['interests'] ?? ''; ?></textarea>
                <input type="number" step="0.01" name="gpa" placeholder="📊 GPA" value="<?php echo $user['gpa'] ?? ''; ?>">
                <button type="submit">Save Profile</button>
            </form>
        </div>

        <!-- JOB PREVIEW -->
        <div class="card">
            <h3>Recommended Jobs</h3>

            <div class="job-card">
                <h4>Frontend Developer</h4>
                <p>Skills: HTML, CSS, JS</p>
                <button>View</button>
            </div>

            <div class="job-card">
                <h4>Backend Developer</h4>
                <p>Skills: PHP, MySQL</p>
                <button>View</button>
            </div>
        </div>

    </div>
</div>

<script>
let skills = <?php echo json_encode(array_values(array_filter(array_map('trim', $skills)))); ?>;

function updateHiddenInput() {
    document.getElementById("skillsHidden").value = skills.join(',');
}

function addSkill() {
    let input = document.getElementById("skillInput");
    let value = input.value.trim();

    if (!value) return;

    if (!skills.includes(value)) {
        skills.push(value);

        let tag = document.createElement("span");
        tag.className = "tag";
        tag.innerHTML = value + ' <button type="button" onclick="removeSkill(this)">×</button>';

        document.getElementById("skillsContainer").appendChild(tag);

        input.value = "";
        updateHiddenInput();
    }
}

function removeSkill(btn) {
    let tag = btn.parentElement;
    let text = tag.innerText.replace('×','').trim();

    skills = skills.filter(s => s !== text);

    tag.remove();
    updateHiddenInput();
}

updateHiddenInput();
</script>