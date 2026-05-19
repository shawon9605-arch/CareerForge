<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $email = (string) $request->session()->get('email', '');
        if ($email === '') {
            return redirect()->route('student.login');
        }

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $content = trim((string) ($validated['content'] ?? ''));

        if ($content !== '') {
            DB::table('posts')->insert([
                'email' => $email,
                'content' => $content,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('student.community');
    }
}
