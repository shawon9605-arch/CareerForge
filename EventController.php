<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW EVENTS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        // CHECK LOGIN
        if (
            !request()
            ->session()
            ->has('user')
        ) {

            return redirect('/login');

        }

        // CURRENT USER
        $user = request()

            ->session()

            ->get('user');

        // USER EVENTS
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

        return view(
            'events',
            compact('events')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE EVENT
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        // CURRENT USER
        $user = request()

            ->session()

            ->get('user');

        // INSERT EVENT
        DB::table('events')->insert([

            'student_id' =>
            $user->id,

            'title' =>
            $request->title,

            'type' =>
            $request->type,

            'event_date' =>
            $request->event_date,

            'description' =>
            $request->description

        ]);

        return redirect('/events');
    }
}