<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function index()
    {
        // CHECK LOGIN
        if (!session()->has('user')) {

            return redirect('/login');

        }

        // CURRENT USER
        $user = session('user');

        // GET JOBS
        $jobs = DB::table('jobs')->get();

        // SEND TO VIEW
        return view(
            'jobs',
            compact(
                'jobs',
                'user'
            )
        );
    }
}