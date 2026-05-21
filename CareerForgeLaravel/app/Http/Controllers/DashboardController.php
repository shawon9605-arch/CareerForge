<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // TEMP USER
        $user = DB::table('students')->first();

        $skills = [];

        if (!empty($user->skills)) {
            $skills = explode(',', $user->skills);
        }

        return view('dashboard', compact('user', 'skills'));
    }
}