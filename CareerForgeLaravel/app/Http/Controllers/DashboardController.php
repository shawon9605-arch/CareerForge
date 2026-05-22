<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // CHECK LOGIN
        if (!session()->has('user')) {

            return redirect('/login');

        }

        // CURRENT USER
        $user = session('user');

        // SKILLS
        $skills = [];

        if (!empty($user->skills)) {

            $skills =
            explode(',', $user->skills);

        }

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

            ->limit(5)

            ->get();

        return view(
            'dashboard',
            compact(
                'user',
                'skills',
                'events'
            )
        );
    }
}