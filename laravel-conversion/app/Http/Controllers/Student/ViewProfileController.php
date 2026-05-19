<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewProfileController extends Controller
{
    public function show(Request $request)
    {
        $email = (string) $request->query('email', '');
        $user = DB::table('students')->where('email', $email)->first();

        if (!$user) {
            abort(404);
        }

        $skills = [];
        if (!empty($user->skills)) {
            $skills = array_map('trim', explode(',', (string) $user->skills));
        }

        return view('student.view_profile', [
            'user' => $user,
            'skills' => $skills,
        ]);
    }
}
