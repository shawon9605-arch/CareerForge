<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('login');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW REGISTER
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('register');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER USER
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        // CHECK EXISTING EMAIL
        $exists = DB::table('students')

            ->where(
                'email',
                $request->email
            )

            ->first();

        if ($exists) {

            return back()->with(
                'error',
                'Email already exists'
            );

        }

        // INSERT USER
        DB::table('students')->insert([

            'name' =>
            $request->name,

            'email' =>
            $request->email,

            'password' =>
            md5($request->password),

            'created_at' =>
            now(),

            'updated_at' =>
            now()

        ]);

        return redirect('/login')

            ->with(
                'success',
                'Account Created Successfully'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN USER
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $user = DB::table('students')

            ->where(
                'email',
                $request->email
            )

            ->where(
                'password',
                md5($request->password)
            )

            ->first();

        if ($user) {

            session([
                'user' => $user
            ]);

            return redirect('/');

        }

        return back()->with(
            'error',
            'Invalid Email or Password'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        session()->forget('user');

        return redirect('/login');
    }
}