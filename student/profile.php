<?php
include('../config/db.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* 🔐 LOGIN CHECK */
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];

$stmt = $conn->prepare('SELECT * FROM students WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result ? $result->fetch_assoc() : null;
$stmt->close();

if (!$user) {
    die("User not found. Please login again.");
}

$skills = [];
if (!empty($user['skills'])) {
    $skills = explode(',', $user['skills']);
}

$imageSrc = '../assets/user.png';
if (!empty($user['image'])) {
    if (strpos($user['image'], 'uploads/') === 0) {
        $imageSrc = '../' . $user['image'];
    } else {
        $imageSrc = $user['image'];
    }
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
                <img src="<?php echo htmlspecialchars($imageSrc); ?>" class="profile-img">

                <h2><?php echo htmlspecialchars($user['name'] ?? 'Student'); ?></h2>
                <p><?php echo htmlspecialchars($user['email'] ?? ''); ?></p>

                <button onclick="openCV()">📄 View CV</button>
                <button onclick="downloadCV()">⬇ Download CV</button>

                <div class="profile-upload">
                    <label for="profileImageInput">🖼️ Change Profile Picture</label>
                    <input type="file" id="profileImageInput" accept="image/*">
                    <small class="hint">JPG / PNG / WEBP • Max 2MB</small>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="profile-right">

                <!-- BASIC INFO -->
                <div class="card">
                    <h3>👤 Basic Info</h3>
                    <input type="text" id="nameInput" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" placeholder="👤 Full Name">
                    <input type="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" disabled>
                </div>

                <!-- GPA -->
                <div class="card">
                    <h3>🎓 Academic</h3>
                    <input type="number" step="0.01" id="gpaInput" value="<?php echo htmlspecialchars((string)($user['gpa'] ?? '')); ?>" placeholder="📊 GPA">
                </div>

                <!-- INTERESTS -->
                <div class="card">
                    <h3>🎯 Interests</h3>
                    <textarea id="interestInput" placeholder="🎯 Your Interests"><?php echo htmlspecialchars($user['interests'] ?? ''); ?></textarea>
                </div>

                <!-- SKILLS -->
                <div class="card">
                    <h3>💡 Skills</h3>
                    <div class="tags" id="skillsContainer"></div>

                    <div class="skill-input">
                        <input type="text" id="skillInput" placeholder="Add a skill">
                        <button type="button" onclick="addSkill()">Add</button>
                    </div>
                </div>
                <!-- EDUCATION -->
                <div class="card">
                    <h3>🎓 Academic Background</h3>
                    <textarea id="educationInput" placeholder="Your education..."><?php echo $user['education'] ?? ''; ?></textarea>
                </div>

                <!-- EXPERIENCE -->
                <div class="card">
                    <h3>💼 Work Experience</h3>
                    <textarea id="experienceInput" placeholder="Your experience..."><?php echo $user['experience'] ?? ''; ?></textarea>
                </div>

                <!-- PROJECTS -->
                <div class="card">
                <h3>📁 Projects</h3>

                <div id="projectContainer"></div>

                <div class="project-input">
                    <input type="text" id="projTitle" placeholder="Project Title">
                    <input type="text" id="projDesc" placeholder="Description">
                    <input type="text" id="projLink" placeholder="GitHub Link">

                    <button type="button" onclick="addProject()">Add Project</button>
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
let skills = <?php echo json_encode(array_values(array_filter(array_map('trim', $skills)))); ?>;

function renderSkills() {
    const container = document.getElementById("skillsContainer");
    container.innerHTML = "";

    skills.forEach((skill) => {
        const tag = document.createElement("span");
        tag.className = "tag";

        const text = document.createElement("span");
        text.textContent = skill;

        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "remove-btn";
        btn.textContent = "×";
        btn.addEventListener("click", () => removeSkill(skill));

        tag.appendChild(text);
        tag.appendChild(btn);
        container.appendChild(tag);
    });
}

function addSkill() {
    const input = document.getElementById("skillInput");
    const value = (input.value || "").trim();
    if (!value) return;

    if (!skills.includes(value)) {
        skills.push(value);
        renderSkills();
    }

    input.value = "";
}

function removeSkill(skill) {
    skills = skills.filter((s) => s !== skill);
    renderSkills();
}

function saveProfile() {
    const name = document.getElementById("nameInput").value;
    const gpa = document.getElementById("gpaInput").value;
    const interests = document.getElementById("interestInput").value;
    const education = document.getElementById("educationInput").value;
    const experience = document.getElementById("experienceInput").value;
    const projects = document.getElementById("projectsInput").value;

    const imageFile = document.getElementById("profileImageInput").files[0];

    const body = new FormData();
    body.set("ajax", "1");
    body.set("name", name);
    body.set("gpa", gpa);
    body.set("interests", interests);
    body.set("education", education);
    body.set("experience", experience);
    body.set("projects", projects);
    body.set("skills", skills.join(','));

    if (imageFile) {
        body.set("profile_image", imageFile);
    }

    fetch("save_profile.php", {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        },
        body
    })
    .then(async (res) => {
        const data = await res.json().catch(() => null);
        if (!res.ok || !data) {
            throw new Error((data && data.message) ? data.message : "Failed to update profile");
        }
        return data;
    })
    .then(() => {
        alert("Profile updated!");
        location.reload();
    })
    .catch((err) => {
        alert(err.message || "Failed to update profile");
    });
}

function downloadCV() {
    window.open("cv.php", "_blank");
}

function openCV() {
    window.open("cv.php", "_blank");
}

renderSkills();
</script>

<script>
let projects = <?php echo $user['projects'] ? $user['projects'] : '[]'; ?>;
projects = JSON.parse(projects || "[]");
</script>

<script>
function renderProjects() {
    let container = document.getElementById("projectContainer");
    container.innerHTML = "";

    projects.forEach((p, index) => {
        let card = document.createElement("div");
        card.className = "project-card";

        card.innerHTML = `
    <h4>${p.title}</h4>
    <p>${p.desc}</p>

    <a href="${p.link}" target="_blank" onclick="increaseView(${index})">
        🔗 GitHub
    </a>

    <div class="project-meta">
        ⭐ Rating: ${p.rating}
        👁️ Views: ${p.views}
    </div>

    <div class="rating-buttons">
        <button onclick="rateProject(${index}, 1)">⭐</button>
        <button onclick="rateProject(${index}, 2)">⭐⭐</button>
        <button onclick="rateProject(${index}, 3)">⭐⭐⭐</button>
        <button onclick="rateProject(${index}, 4)">⭐⭐⭐⭐</button>
        <button onclick="rateProject(${index}, 5)">⭐⭐⭐⭐⭐</button>
    </div>

    <button onclick="removeProject(${index})">❌ Remove</button>
`;

        container.appendChild(card);
    });
}

function addProject() {
    let title = document.getElementById("projTitle").value.trim();
    let desc = document.getElementById("projDesc").value.trim();
    let link = document.getElementById("projLink").value.trim();

    if (!title || !link) return;

    projects.push({
    title,
    desc,
    link,
    rating: 0,
    views: 0
    });

    renderProjects();
    updateProjectsInput();

    document.getElementById("projTitle").value = "";
    document.getElementById("projDesc").value = "";
    document.getElementById("projLink").value = "";
}

function removeProject(index) {
    projects.splice(index, 1);
    renderProjects();
    updateProjectsInput();
}

function updateProjectsInput() {
    document.getElementById("projectsHidden").value = JSON.stringify(projects);
}

function rateProject(index, value) {
    projects[index].rating = value;
    renderProjects();
    updateProjectsInput();
}

function increaseView(index) {
    projects[index].views += 1;
    updateProjectsInput();
}
// INIT
renderProjects();
</script>