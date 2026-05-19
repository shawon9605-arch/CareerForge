<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(Request $request): View
    {
        return view('student.login');
    }

    public function login(Request $request): RedirectResponse|View
    {
        $email = strtolower(trim((string) $request->input('email', '')));
        $password = (string) $request->input('password', '');

        $hashed = md5($password);

        $user = DB::table('students')
            ->whereRaw('LOWER(TRIM(email)) = ?', [$email])
            ->where('password', $hashed)
            ->first();

        if ($user) {
            $request->session()->put('email', $email);
            return redirect()->route('student.dashboard');
        }

        return view('student.login', [
            'error' => 'Invalid Login',
        ]);
    }

    public function showRegister(): View
    {
        return view('student.register');
    }

    public function register(Request $request): View
    {
        $name = (string) $request->input('name', '');
        $email = strtolower(trim((string) $request->input('email', '')));
        $password = (string) $request->input('password', '');

        DB::table('students')->insert([
            'name' => $name,
            'email' => $email,
            'password' => md5($password),
            'created_at' => now(),
        ]);

        return view('student.register', [
            'registered' => true,
        ]);
    }
}
