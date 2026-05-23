<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    // SHOW EVENTS PAGE

    public function index()
    {
        $user = session('user');

        // LOGIN CHECK
        if (!$user) {

            return redirect('/login');

        }

        // GET USER EVENTS
        $events = DB::table('events')

            ->where(
                'student_id',
                $user->id
            )

            ->orderBy(
                'event_date',
                'asc'
            )

            ->get();

        return view('events', [

            'events' => $events,

            'user' => $user

        ]);
    }

    // STORE EVENT

    public function store(Request $request)
    {
        $user = session('user');

        // LOGIN CHECK
        if (!$user) {

            return redirect('/login');

        }

        DB::table('events')

            ->insert([

                'student_id' =>
                $user->id,

                'title' =>
                $request->title,

                'type' =>
                $request->type,

                'event_date' =>
                $request->event_date,

                'description' =>
                $request->description,

                'created_at' =>
                now(),

                'updated_at' =>
                now()

            ]);

        return redirect('/events')

            ->with(
                'success',
                'Event Added Successfully!'
            );
    }

    // UPDATE EVENT

    public function update(Request $request, $id)
    {
        $user = session('user');

        // LOGIN CHECK
        if (!$user) {

            return redirect('/login');

        }

        DB::table('events')

            ->where(
                'id',
                $id
            )

            ->where(
                'student_id',
                $user->id
            )

            ->update([

                'title' =>
                $request->title,

                'type' =>
                $request->type,

                'event_date' =>
                $request->event_date,

                'description' =>
                $request->description,

                'updated_at' =>
                now()

            ]);

        return redirect('/events')

            ->with(
                'success',
                'Event Updated Successfully!'
            );
    }
}