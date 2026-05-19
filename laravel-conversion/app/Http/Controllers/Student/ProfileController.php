<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfileController extends Controller
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

        $imageSrc = asset('assets/user.png');
        if (!empty($user->image)) {
            $raw = (string) $user->image;
            if (str_starts_with($raw, 'uploads/')) {
                $imageSrc = asset($raw);
            } else {
                $imageSrc = $raw;
            }
        }

        return view('student.profile', [
            'user' => $user,
            'skills' => $skills,
            'imageSrc' => $imageSrc,
        ]);
    }
}
