<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // CHECK LOGIN
        if (!session()->has('user')) {

            return redirect('/login');

        }

        // LOGGED USER
        $user = session('user');

        // SKILLS ARRAY
        $skills = [];

        if (!empty($user->skills)) {

            $skills =
            explode(',', $user->skills);

        }

        return view(
            'dashboard',
            compact(
                'user',
                'skills'
            )
        );
    }
}