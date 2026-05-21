<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>CareerForge Profile</title>

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

    </div>

    <!-- MAIN -->
    <div class="main">

        <h1>👤 My Profile</h1>

        <div class="profile-container">

            <!-- LEFT -->
            <div class="profile-left card">

                <img
                    src="{{ asset($user->image ?? 'assets/user.png') }}"
                    class="profile-img"
                >

                <h2>
                    {{ $user->name ?? 'Student' }}
                </h2>

                <p>
                    {{ $user->email ?? '' }}
                </p>

                <button onclick="openCV()">
                    📄 View CV
                </button>

                <button onclick="downloadCV()">
                    ⬇ Download CV
                </button>

                <div class="profile-upload">

                    <label for="profileImageInput">
                        🖼️ Change Profile Picture
                    </label>

                    <input
                        type="file"
                        id="profileImageInput"
                        accept="image/*"
                    >

                </div>

            </div>

            <!-- RIGHT -->
            <div class="profile-right">

                <!-- BASIC INFO -->
                <div class="card">

                    <h3>👤 Basic Info</h3>

                    <input
                        type="text"
                        id="nameInput"
                        value="{{ $user->name ?? '' }}"
                        placeholder="👤 Full Name"
                    >

                    <input
                        type="email"
                        value="{{ $user->email ?? '' }}"
                        disabled
                    >

                </div>

                 <!-- CV TEMPLATE -->
                <div class="card">

                    <h3>
                        🎨 CV Template
                    </h3>

                    <div class="template-select-wrapper">

                        <select
                            id="cvTemplate"
                            class="template-select"
                        >

                            <option value="modern">
                                ✨ Modern
                            </option>

                            <option value="professional">
                                💼 Professional
                            </option>

                            <option value="minimal">
                                📄 Minimal
                            </option>

                            <option value="dark">
                                🌙 Dark
                            </option>

                        </select>

                    </div>

                </div>

                <!-- GPA -->
                <div class="card">

                    <h3>🎓 Academic</h3>

                    <input
                        type="number"
                        step="0.01"
                        id="gpaInput"
                        value="{{ $user->gpa ?? '' }}"
                        placeholder="📊 GPA"
                    >

                </div>

                <!-- INTERESTS -->
                <div class="card">

                    <h3>🎯 Interests</h3>

                    <textarea
                        id="interestInput"
                        placeholder="🎯 Your Interests"
                    >{{ $user->interests ?? '' }}</textarea>

                </div>

                <!-- SKILLS -->
                <div class="card">

                    <h3>💡 Skills</h3>

                    <div class="tags"
                         id="skillsContainer">

                    </div>

                    <div class="skill-input">

                        <input
                            type="text"
                            id="skillInput"
                            placeholder="Add a skill"
                        >

                        <button
                            type="button"
                            onclick="addSkill()"
                        >
                            Add
                        </button>

                    </div>

                </div>

                <!-- EDUCATION -->
                <div class="card">

                    <h3>🎓 Academic Background</h3>

                    <textarea
                        id="educationInput"
                        placeholder="Your education..."
                    >{{ $user->education ?? '' }}</textarea>

                </div>

                <!-- EXPERIENCE -->
                <div class="card">

                    <h3>💼 Work Experience</h3>

                    <textarea
                        id="experienceInput"
                        placeholder="Your experience..."
                    >{{ $user->experience ?? '' }}</textarea>

                </div>

                <!-- PROJECTS -->
                <div class="card">

                    <h3>📁 Projects</h3>

                    <div id="projectContainer"></div>

                    <div class="project-input">

                        <input
                            type="text"
                            id="projTitle"
                            placeholder="Project Title"
                        >

                        <input
                            type="text"
                            id="projDesc"
                            placeholder="Description"
                        >

                        <input
                            type="text"
                            id="projLink"
                            placeholder="GitHub Link"
                        >

                        <button
                            type="button"
                            onclick="addProject()"
                        >
                            Add Project
                        </button>

                    </div>

                </div>

                <!-- SMART SUGGESTIONS -->
                <div class="card">

                    <h3>💡 Smart Suggestions</h3>

                    @php
                        $skillsText = strtolower($user->skills ?? '');
                    @endphp

                    @if(strpos($skillsText, 'javascript') === false)

                        <p>
                            👉 Learn JavaScript for frontend roles
                        </p>

                    @endif

                    @if(strpos($skillsText, 'api') === false)

                        <p>
                            👉 Learn API development for backend roles
                        </p>

                    @endif

                    @if(strpos($skillsText, 'react') === false)

                        <p>
                            👉 Consider learning React
                        </p>

                    @endif

                    @if(strpos($skillsText, 'mysql') === false)

                        <p>
                            👉 Improve database skills (MySQL)
                        </p>

                    @endif

                </div>

                <!-- SAVE BUTTON -->
                <button
                    class="save-btn"
                    onclick="saveProfile()"
                >
                    Save Changes
                </button>

            </div>

        </div>

    </div>

</div>

<!-- ======================= -->
<!-- SKILLS JS -->
<!-- ======================= -->

<script>

let skills =
JSON.parse('@json($skills)');

function renderSkills() {

    let container =
    document.getElementById("skillsContainer");

    container.innerHTML = "";

    skills.forEach((skill) => {

        let tag =
        document.createElement("span");

        tag.className = "tag";

        tag.innerHTML = `

            ${skill}

            <button
                type="button"
                class="remove-btn"
                onclick="removeSkill('${skill}')"
            >
                ×
            </button>

        `;

        container.appendChild(tag);

    });

}

function addSkill() {

    let input =
    document.getElementById("skillInput");

    let value =
    input.value.trim();

    if (!value) return;

    if (!skills.includes(value)) {

        skills.push(value);

        renderSkills();

    }

    input.value = "";

}

function removeSkill(skill) {

    skills =
    skills.filter(s => s !== skill);

    renderSkills();

}

renderSkills();

</script>

<!-- ======================= -->
<!-- PROJECTS JS -->
<!-- ======================= -->

<script>

let projects =
JSON.parse('@json(json_decode($user->projects ?? "[]"))');

function renderProjects() {

    let container =
    document.getElementById("projectContainer");

    container.innerHTML = "";

    projects.forEach((p, index) => {

        let card =
        document.createElement("div");

        card.className = "project-card";

        card.innerHTML = `

            <h4>${p.title}</h4>

            <p>${p.desc}</p>

            <a href="${p.link}"
               target="_blank"
               onclick="increaseView(${index})">
               🔗 GitHub
            </a>

            <div class="project-meta">

                ⭐ Rating:
                ${p.rating || 0}

                👁️ Views:
                ${p.views || 0}

            </div>

            <div class="rating-buttons">

                <button onclick="rateProject(${index},1)">
                    ⭐
                </button>

                <button onclick="rateProject(${index},2)">
                    ⭐⭐
                </button>

                <button onclick="rateProject(${index},3)">
                    ⭐⭐⭐
                </button>

                <button onclick="rateProject(${index},4)">
                    ⭐⭐⭐⭐
                </button>

                <button onclick="rateProject(${index},5)">
                    ⭐⭐⭐⭐⭐
                </button>

            </div>

            <button onclick="removeProject(${index})">
                ❌ Remove
            </button>

        `;

        container.appendChild(card);

    });

}

function addProject() {

    let title =
    document.getElementById("projTitle").value.trim();

    let desc =
    document.getElementById("projDesc").value.trim();

    let link =
    document.getElementById("projLink").value.trim();

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

renderProjects();

</script>

<!-- ======================= -->
<!-- SAVE PROFILE -->
<!-- ======================= -->

<script>

function saveProfile() {

    let formData = new FormData();

    formData.append(
        "name",
        document.getElementById("nameInput").value
    );

    formData.append(
    "cv_template",
    document.getElementById("cvTemplate").value
    );

    formData.append(
        "gpa",
        document.getElementById("gpaInput").value
    );

    formData.append(
        "interests",
        document.getElementById("interestInput").value
    );

    formData.append(
        "education",
        document.getElementById("educationInput").value
    );

    formData.append(
        "experience",
        document.getElementById("experienceInput").value
    );

    formData.append(
        "skills",
        skills.join(',')
    );

    formData.append(
        "projects",
        JSON.stringify(projects)
    );

    let imageInput =
    document.getElementById("profileImageInput");

    if (imageInput.files.length > 0) {

        formData.append(
            "profile_image",
            imageInput.files[0]
        );

    }

    fetch("/profile/update", {

        method: "POST",

        headers: {

            "X-CSRF-TOKEN":
            "{{ csrf_token() }}"

        },

        body: formData

    })

    .then(res => res.json())

    .then(data => {

        alert("✅ Profile updated successfully!");

        location.reload();

    })

    .catch(err => {

        console.error(err);

        alert("❌ Error saving profile");

    });

}

function openCV() {

    window.open("/cv", "_blank");

}

function downloadCV() {

    window.open("/cv/download", "_blank");

}

</script>

</body>
</html>