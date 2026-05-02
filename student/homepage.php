<!DOCTYPE html>
<html>
<head>
    <title>CareerForge</title>
    <link rel="stylesheet" href="../assets/style.css">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b, #312e81);
            color: white;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 60px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .nav-buttons a {
            padding: 10px 18px;
            border-radius: 10px;
            margin-left: 10px;
            text-decoration: none;
        }

        .btn-main {
            background: linear-gradient(45deg, #ff7a00, #ffb347);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid #ff7a00;
            color: #ff7a00;
        }

        /* HERO */
        .center-box {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .center-box h1 {
            font-size: 42px;
        }

        .live {
            color: #ff7a00;
            border-bottom: 2px solid #ff7a00;
            text-decoration: none;
        }

        .hero-image img {
            width: 100%;
            max-width: 700px;
            border-radius: 12px;
            margin: 20px 0;
        }

        .sub-text {
            color: #aaa;
            font-size: 14px;
        }

        /* NEW SECTION */
        .features {
            padding: 80px 60px;
            text-align: center;
        }

        .features h2 {
            font-size: 32px;
            margin-bottom: 40px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }

        .feature-box {
            background: rgba(255,255,255,0.08);
            padding: 30px;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            transition: 0.3s;
            cursor: pointer;
        }

        .feature-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 0 20px rgba(255,122,0,0.3);
        }

        .feature-box img {
            width: 50px;
            margin-bottom: 15px;
        }

        /* STATS */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stat-box {
            background: rgba(255,255,255,0.08);
            padding: 30px;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            text-align: center;
            transition: 0.3s;
        }

        .stat-box:hover {
            transform: translateY(-5px);
        }

        .stat-box h3 {
            font-size: 28px;
            color: #ffb347;
        }

        .stat-box p {
            color: #ccc;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">🚀 CareerForge</div>
    <div class="nav-buttons">
        <a href="register.php" class="btn-main">Start Learning</a>
        <a href="login.php" class="btn-outline-custom">Login</a>
    </div>
</div>

<!-- HERO -->
<div class="center-box">
    <div style="max-width:700px; width:100%;">

        <h1>
            Learn Skills in Bangladesh
        </h1>

        <div class="hero-image">
            <img src="homepages.jpg">
        </div>

        <p>Transform your career through skill-based learning</p>

        <p class="sub-text">
            10,000+ graduates are working in local & international companies
        </p>

    </div>
</div>

<!-- 🔥 NEW FEATURES SECTION -->
<div class="features">

    <h2>What You Get in the Live Course</h2>

    <div class="feature-grid">

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/briefcase.png"/>
            <p>Job-ready dedicated placement team</p>
        </div>

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/resume.png"/>
            <p>CV building & expert CV review</p>
        </div>

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/customer-support.png"/>
            <p>18 hours of live support</p>
        </div>

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/medal.png"/>
            <p>Pro batch special CV & job support</p>
        </div>

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/test-passed.png"/>
            <p>Opportunity through live tests</p>
        </div>

        <div class="feature-box">
            <img src="https://img.icons8.com/color/96/puzzle.png"/>
            <p>3-day support class</p>
        </div>

    </div>

    <!-- STATS -->
    <div class="stats">

        <div class="stat-box">
            <h3>9,000+</h3>
            <p>Job Placements</p>
        </div>

        <div class="stat-box">
            <h3>150,000+</h3>
            <p>Learners</p>
        </div>

        <div class="stat-box">
            <h3>83%</h3>
            <p>Completion Rate</p>
        </div>

        <div class="stat-box">
            <h3>28</h3>
            <p>Live Courses</p>
        </div>

    </div>

</div>

</body>

<!-- CHATBOT WIDGET -->
<div class="chatbot">
    <button class="chatbot-fab" id="chatbotFab" type="button" aria-label="Open chatbot">💬</button>

    <div class="chatbot-panel" id="chatbotPanel" aria-hidden="true">
        <div class="chatbot-header">
            <div>
                <strong>CareerForge Assistant</strong>
                <div class="chatbot-subtitle">Ask about courses, CV, jobs</div>
            </div>
            <button type="button" class="chatbot-close" id="chatbotClose" aria-label="Close chatbot">×</button>
        </div>

        <div class="chatbot-messages" id="chatbotMessages"></div>

        <form class="chatbot-input" id="chatbotForm">
            <input id="chatbotText" type="text" placeholder="Type a message..." autocomplete="off" />
            <button type="submit">Send</button>
        </form>
    </div>
</div>

<script>
const fab = document.getElementById('chatbotFab');
const panel = document.getElementById('chatbotPanel');
const closeBtn = document.getElementById('chatbotClose');
const messages = document.getElementById('chatbotMessages');
const form = document.getElementById('chatbotForm');
const input = document.getElementById('chatbotText');

function setOpen(isOpen) {
    panel.classList.toggle('open', isOpen);
    panel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
    if (isOpen) {
        setTimeout(() => input.focus(), 50);
    }
}

function addMessage(role, text) {
    const wrapper = document.createElement('div');
    wrapper.className = 'chatbot-msg ' + (role === 'user' ? 'user' : 'bot');

    const bubble = document.createElement('div');
    bubble.className = 'chatbot-bubble';
    bubble.textContent = text;

    wrapper.appendChild(bubble);
    messages.appendChild(wrapper);
    messages.scrollTop = messages.scrollHeight;
}

function botReply(userText) {
    const t = (userText || '').toLowerCase();

    if (t.includes('login') || t.includes('sign in')) {
        return 'You can login from here: student/login.php (button on top right).';
    }
    if (t.includes('register') || t.includes('signup') || t.includes('sign up')) {
        return 'To create an account, click “Start Learning” or go to student/register.php.';
    }
    if (t.includes('cv') || t.includes('resume')) {
        return 'After login: Dashboard → Profile → View CV / Download CV.';
    }
    if (t.includes('job')) {
        return 'After login you can explore Jobs from the sidebar: Jobs page.';
    }
    if (t.includes('skill')) {
        return 'Tell me what skill you want (e.g., PHP, JavaScript, React) and I will suggest a learning path.';
    }
    if (t.includes('react')) {
        return 'React path: HTML/CSS → JavaScript fundamentals → DOM → React basics → Projects.';
    }
    if (t.includes('php')) {
        return 'PHP path: PHP basics → Forms/Session → MySQL (CRUD) → Build 1–2 projects.';
    }

    return 'Hi! Ask me about Login, Register, CV, Jobs, or Skills.';
}

fab.addEventListener('click', () => {
    const isOpen = panel.classList.contains('open');
    setOpen(!isOpen);
    if (!isOpen && messages.children.length === 0) {
        addMessage('bot', 'Hello! How can I help you today?');
    }
});

closeBtn.addEventListener('click', () => setOpen(false));

form.addEventListener('submit', (e) => {
    e.preventDefault();
    const text = input.value.trim();
    if (!text) return;
    addMessage('user', text);
    input.value = '';

    const reply = botReply(text);
    setTimeout(() => addMessage('bot', reply), 250);
});
</script>
</html>
