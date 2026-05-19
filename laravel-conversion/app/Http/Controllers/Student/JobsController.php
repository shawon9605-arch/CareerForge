<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class JobsController extends Controller
{
    public function show(Request $request): RedirectResponse|View
    {
        $email = (string) $request->session()->get('email', '');
        if ($email === '') {
            return redirect()->route('student.login');
        }

        $row = DB::table('students')->select('skills')->where('email', $email)->first();
        $userSkills = [];

        if ($row && !empty($row->skills)) {
            $userSkills = array_map('trim', explode(',', strtolower((string) $row->skills)));
        }

        return view('student.jobs', [
            'userSkills' => $userSkills,
        ]);
    }
}
