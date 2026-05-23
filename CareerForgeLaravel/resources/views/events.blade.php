<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        CareerForge Events
    </title>

    <link rel="stylesheet"
          href="{{ asset('assets/style.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

</head>

<body>

<!-- SUCCESS MESSAGE -->

@if(session('success'))

    <div id="successMessage"
         style="
            position:fixed;
            top:30px;
            right:30px;
            background:
            linear-gradient(
                90deg,
                #10b981,
                #059669
            );
            color:white;
            padding:18px 28px;
            border-radius:18px;
            z-index:99999;
            font-weight:600;
            box-shadow:
            0 15px 40px rgba(0,0,0,0.35);
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

        <a href="/community">

            🌍 Community

        </a>

        <a href="/quizzes">

            📚 Assessments

        </a>

        <a href="/events"
           class="active">

            📅 Calendar

        </a>

        <a href="/logout"
           class="logout-btn">

            🚪 Logout

        </a>

    </div>

    <!-- MAIN -->

    <div class="main">

        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1 class="page-title">

                    📅 Event & Calendar System

                </h1>

                <p style="opacity:0.7; margin-top:-10px;">

                    Manage your quizzes, deadlines, interviews & schedules

                </p>

            </div>

        </div>

        <!-- ADD EVENT -->

        <div class="card"
             style="margin-bottom:35px;">

            <h2 style="margin-bottom:25px;">

                ➕ Add New Event

            </h2>

            <form
                method="POST"
                action="/events/add"
            >

                @csrf

                <input
                    type="text"
                    name="title"
                    placeholder="Event Title"
                    required
                >

                <br><br>

                <select name="type">

                    <option value="Quiz">

                        Quiz

                    </option>

                    <option value="Exam">

                        Exam

                    </option>

                    <option value="Interview">

                        Interview

                    </option>

                    <option value="Deadline">

                        Deadline

                    </option>

                </select>

                <br><br>

                <input
                    type="date"
                    name="event_date"
                    required
                >

                <br><br>

                <textarea
                    name="description"
                    placeholder="Event Description"
                ></textarea>

                <br><br>

                <button
                    type="submit"
                    style="width:100%;">

                    Add Event

                </button>

            </form>

        </div>

        <!-- EVENTS -->

        <div class="card">

            <div class="section-header">

                <h2>

                    📌 Upcoming Events

                </h2>

                <div class="match">

                    {{ count($events) }}
                    Events

                </div>

            </div>

            @if(count($events) > 0)

                <div style="
                    display:flex;
                    flex-direction:column;
                    gap:25px;
                    margin-top:30px;
                ">

                    @foreach($events as $event)

                        <div class="event-item"
                             style="
                                flex-direction:column;
                                align-items:flex-start;
                                padding:28px;
                             ">

                            <!-- TOP -->

                            <div style="
                                width:100%;
                                display:flex;
                                justify-content:space-between;
                                align-items:center;
                                gap:20px;
                                flex-wrap:wrap;
                                margin-bottom:20px;
                            ">

                                <div>

                                    <div class="event-badge">

                                        {{ $event->type }}

                                    </div>

                                </div>

                                <div style="
                                    opacity:0.7;
                                ">

                                    📅 {{ $event->event_date }}

                                </div>

                            </div>

                            <!-- CONTENT -->

                            <h2 style="
                                margin-bottom:15px;
                            ">

                                {{ $event->title }}

                            </h2>

                            <p style="
                                opacity:0.75;
                                line-height:1.8;
                            ">

                                {{ $event->description }}

                            </p>

                            <!-- BUTTON -->

                            <button
                                onclick="openEditModal(
                                    '{{ $event->id }}',
                                    '{{ $event->title }}',
                                    '{{ $event->type }}',
                                    '{{ $event->event_date }}',
                                    `{{ $event->description }}`
                                )"
                                style="
                                    margin-top:20px;
                                ">

                                ✏ Edit Event

                            </button>

                        </div>

                    @endforeach

                </div>

            @else

                <div style="
                    text-align:center;
                    padding:60px 20px;
                ">

                    <div style="
                        font-size:80px;
                        margin-bottom:20px;
                    ">

                        📅

                    </div>

                    <h2 style="
                        margin-bottom:15px;
                    ">

                        No Events Added Yet

                    </h2>

                    <p style="
                        opacity:0.7;
                        line-height:1.8;
                    ">

                        Create your first event to start tracking schedules.

                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

<!-- EDIT MODAL -->

<div id="editModal"
     style="
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.65);
        display:none;
        justify-content:center;
        align-items:center;
        z-index:9999;
     ">

    <div class="card"
         style="
            width:520px;
            max-width:92%;
         ">

        <div class="section-header">

            <h2>

                ✏ Update Event

            </h2>

            <button
                onclick="closeEditModal()"
                style="
                    width:42px;
                    height:42px;
                    border-radius:12px;
                    padding:0;
                ">

                ✕

            </button>

        </div>

        <form
            method="POST"
            id="editForm"
        >

            @csrf

            <input
                type="text"
                name="title"
                id="editTitle"
                placeholder="Event Title"
                required
            >

            <br><br>

            <select
                name="type"
                id="editType"
            >

                <option value="Quiz">

                    Quiz

                </option>

                <option value="Exam">

                    Exam

                </option>

                <option value="Interview">

                    Interview

                </option>

                <option value="Deadline">

                    Deadline

                </option>

            </select>

            <br><br>

            <input
                type="date"
                name="event_date"
                id="editDate"
                required
            >

            <br><br>

            <textarea
                name="description"
                id="editDescription"
                placeholder="Description"
            ></textarea>

            <br><br>

            <button
                type="submit"
                style="width:100%;">

                Save Changes

            </button>

        </form>

    </div>

</div>

<!-- SCRIPT -->

<script>

function openEditModal(
    id,
    title,
    type,
    date,
    description
) {

    document
        .getElementById(
            'editModal'
        )
        .style.display = 'flex';

    document
        .getElementById(
            'editTitle'
        )
        .value = title;

    document
        .getElementById(
            'editType'
        )
        .value = type;

    document
        .getElementById(
            'editDate'
        )
        .value = date;

    document
        .getElementById(
            'editDescription'
        )
        .value = description;

    document
        .getElementById(
            'editForm'
        )
        .action =
        '/events/update/' + id;

}

function closeEditModal() {

    document
        .getElementById(
            'editModal'
        )
        .style.display = 'none';

}

// AUTO HIDE SUCCESS MESSAGE

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