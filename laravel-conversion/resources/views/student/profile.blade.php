<?php
/** @var object $user */
/** @var array<int, string> $skills */
/** @var string $imageSrc */
?>

<link rel="stylesheet" href="{{ asset('assets/style.css') }}">

<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>🔥 CareerForge</h2>
        <a href="{{ route('student.dashboard') }}">Dashboard</a>
        <a href="{{ route('student.profile') }}">Profile</a>
        <a href="{{ route('student.jobs') }}">Jobs</a>
        <a href="{{ route('student.community') }}">Community</a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <h1>👤 My Profile</h1>

        <div class="profile-container">

            <!-- LEFT -->
            <div class="profile-left card">
                <img src="{{ $imageSrc }}" class="profile-img">

                <h2>{{ $user->name ?? 'Student' }}</h2>
                <p>{{ $user->email ?? '' }}</p>

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
                    <input type="text" id="nameInput" value="{{ $user->name ?? '' }}" placeholder="👤 Full Name">
                    <input type="email" value="{{ $user->email ?? '' }}" disabled>
                </div>

                <!-- GPA -->
                <div class="card">
                    <h3>🎓 Academic</h3>
                    <input type="number" step="0.01" id="gpaInput" value="{{ (string)($user->gpa ?? '') }}" placeholder="📊 GPA">
                </div>

                <!-- INTERESTS -->
                <div class="card">
                    <h3>🎯 Interests</h3>
                    <textarea id="interestInput" placeholder="🎯 Your Interests">{{ $user->interests ?? '' }}</textarea>
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
                    <textarea id="educationInput" placeholder="Your education...">{{ $user->education ?? '' }}</textarea>
                </div>

                <!-- EXPERIENCE -->
                <div class="card">
                    <h3>💼 Work Experience</h3>
                    <textarea id="experienceInput" placeholder="Your experience...">{{ $user->experience ?? '' }}</textarea>
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

                    <?php $skillsText = strtolower((string)($user->skills ?? '')); ?>

                    @if(strpos($skillsText, 'javascript') === false)
                        <p>👉 Learn JavaScript for frontend roles</p>
                    @endif

                    @if(strpos($skillsText, 'api') === false)
                        <p>👉 Learn API development for backend roles</p>
                    @endif

                    @if(strpos($skillsText, 'react') === false)
                        <p>👉 Consider learning React</p>
                    @endif

                    @if(strpos($skillsText, 'mysql') === false)
                        <p>👉 Improve database skills (MySQL)</p>
                    @endif
                </div>

                <button class="save-btn" onclick="saveProfile()">Save Changes</button>

            </div>

        </div>

    </div>
</div>

<div
    id="profileData"
    data-skills="{{ e(json_encode(array_values(array_filter(array_map('trim', $skills))))) }}"
    data-projects="{{ e(!empty($user->projects) ? $user->projects : '[]') }}"
    hidden
></div>

<!-- JS -->
<script>
let skills = [];
let projects = [];

try {
    const profileDataEl = document.getElementById("profileData");
    skills = JSON.parse((profileDataEl && profileDataEl.dataset.skills) ? profileDataEl.dataset.skills : "[]");
    if (!Array.isArray(skills)) skills = [];
} catch (e) {
    skills = [];
}

try {
    const profileDataEl = document.getElementById("profileData");
    projects = JSON.parse((profileDataEl && profileDataEl.dataset.projects) ? profileDataEl.dataset.projects : "[]");
    if (!Array.isArray(projects)) projects = [];
} catch (e) {
    projects = [];
}

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
    let formData = new FormData();

    formData.append("name", document.getElementById("nameInput").value);
    formData.append("gpa", document.getElementById("gpaInput").value);
    formData.append("interests", document.getElementById("interestInput").value);
    formData.append("education", document.getElementById("educationInput").value);
    formData.append("experience", document.getElementById("experienceInput").value);

    formData.append("skills", skills.join(','));

    formData.append("projects", JSON.stringify(projects));

    // IMAGE
    let imageInput = document.getElementById("profileImageInput");

    if (imageInput.files.length > 0) {
        formData.append("profile_image", imageInput.files[0]);
    }

    fetch("{{ route('student.profile.save') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        console.log(data);

        alert("✅ Profile updated successfully!");

        location.reload();
    })
    .catch(err => {
        console.error(err);
        alert("Error saving profile");
    });
}

function downloadCV() {
    window.open("{{ route('student.cv') }}", "_blank");
}

function openCV() {
    window.open("{{ route('student.cv') }}", "_blank");
}

renderSkills();
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

    document.getElementById("projTitle").value = "";
    document.getElementById("projDesc").value = "";
    document.getElementById("projLink").value = "";
}

function removeProject(index) {
    projects.splice(index, 1);
    renderProjects();
}

function rateProject(index, value) {
    projects[index].rating = value;
    renderProjects();
}

function increaseView(index) {
    projects[index].views += 1;
}
// INIT
renderProjects();
</script>
