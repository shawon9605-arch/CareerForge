<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CvController extends Controller
{
    public function show(Request $request): RedirectResponse|View
    {
        $email = (string) $request->session()->get('email', '');
        if ($email === '') {
            return redirect()->route('student.login');
        }

        $user = DB::table('students')->where('email', $email)->first();
        if (!$user) {
            abort(500, 'User not found. Please login again.');
        }

        $skills = [];
        if (!empty($user->skills)) {
            $skills = array_map('trim', explode(',', (string) $user->skills));
        }

        return view('student.cv', [
            'user' => $user,
            'skills' => $skills,
        ]);
    }
}
