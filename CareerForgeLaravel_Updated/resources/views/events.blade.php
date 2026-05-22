<!DOCTYPE html>
<html>

<head>

    <title>
        CareerForge Calendar
    </title>

    <link rel="stylesheet"
          href="{{ asset('assets/style.css') }}">

    <style>

        body {

            background:
            linear-gradient(
                135deg,
                #0f172a,
                #1e1b4b
            );

            color: white;

            font-family: Poppins;

        }

        .container {

            width: 90%;

            margin: 40px auto;

        }

        .title {

            font-size: 40px;

            margin-bottom: 30px;

        }

        .card {

            background:
            rgba(255,255,255,0.08);

            border:
            1px solid rgba(255,255,255,0.08);

            backdrop-filter: blur(15px);

            border-radius: 25px;

            padding: 30px;

            margin-bottom: 30px;

        }
        input,
        textarea {

            width: 100%;

            padding: 16px;

            border-radius: 16px;

            border: none;

            background:
            rgba(255,255,255,0.08);

            color: white;

            margin-top: 10px;

            margin-bottom: 20px;

            outline: none;

        }

        button {

            padding: 16px 25px;

            border: none;

            border-radius: 16px;

            background:
            linear-gradient(
                90deg,
                #4f46e5,
                #7c3aed
            );

            color: white;

            cursor: pointer;

            font-weight: 600;

        }

        .event {

            padding: 20px;

            border-radius: 18px;

            background:
            rgba(255,255,255,0.06);

            margin-bottom: 20px;

        }

        .badge {

            display: inline-block;

            padding: 8px 15px;

            border-radius: 20px;

            margin-bottom: 10px;

            background:
            linear-gradient(
                90deg,
                #7c3aed,
                #4f46e5
            );

        }
        select {

        width: 100%;

        padding: 16px 20px;

        border-radius: 18px;

        border:
        1px solid rgba(255,255,255,0.08);

        background:
        rgba(255,255,255,0.08);

        color: white;

        font-size: 15px;

        outline: none;

        cursor: pointer;

        appearance: none;

        -webkit-appearance: none;

        -moz-appearance: none;

        transition: 0.3s ease;

        background-image:
        linear-gradient(
            45deg,
            transparent 50%,
            white 50%
        ),
        linear-gradient(
            135deg,
            white 50%,
            transparent 50%
        );

        background-position:
        calc(100% - 20px) calc(50% - 3px),
        calc(100% - 14px) calc(50% - 3px);

        background-size:
        6px 6px,
        6px 6px;

        background-repeat: no-repeat;

    }

    select:focus {

        border-color: #7c3aed;

        box-shadow:
        0 0 0 4px rgba(124,58,237,0.2);

    }

    select option {

        background: #1e1b4b;

        color: white;

        padding: 15px;

    }

    </style>

</head>

<body>

<div class="container">

    <h1 class="title">

        📅 Event & Calendar System

    </h1>

    <!-- ADD EVENT -->

    <div class="card">

        <h2>

            Add New Event

        </h2>

        <form method="POST"
              action="/events/add">

            @csrf

            <input
                type="text"
                name="title"
                placeholder="Event Title"
                required
            >

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

            <input
                type="date"
                name="event_date"
                required
            >

            <textarea
                name="description"
                placeholder="Description"
            ></textarea>

            <button>

                Add Event

            </button>

        </form>

    </div>

    <!-- EVENTS -->

    <div class="card">

        <h2>

            Upcoming Events

        </h2>

        @foreach($events as $event)

            <div class="event">

                <div class="badge">

                    {{ $event->type }}

                </div>

                <h3>

                    {{ $event->title }}

                </h3>

                <p>

                    📅 {{ $event->event_date }}

                </p>

                <p>

                    {{ $event->description }}

                </p>

            </div>

        @endforeach

    </div>

</div>

</body>

</html>