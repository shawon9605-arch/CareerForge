<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $email = (string) $request->session()->get('email', '');

        if ($email === '') {
            return redirect()->route('student.login');
        }

        $validated = $request->validate([
            'post_id' => ['required', 'integer', 'min:1', 'exists:posts,id'],
            'comment' => ['required', 'string', 'max:500'],
        ]);

        $postId = (int) ($validated['post_id'] ?? 0);
        $comment = trim((string) ($validated['comment'] ?? ''));

        if ($comment !== '') {
            DB::table('comments')->insert([
                'post_id' => $postId,
                'email' => $email,
                'comment' => $comment,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('student.community');
    }
}
