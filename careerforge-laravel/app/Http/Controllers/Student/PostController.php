<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $email = strtolower(trim((string) $request->session()->get('email', '')));
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

    public function update(Request $request, int $postId)
    {
        $email = strtolower(trim((string) $request->session()->get('email', '')));
        if ($email === '') {
            return redirect()->route('student.login');
        }

        $post = DB::table('posts')->where('id', $postId)->first();
        if (!$post) {
            return redirect()->route('student.community');
        }

        $postEmail = strtolower(trim((string) ($post->email ?? '')));
        if ($postEmail !== $email) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $content = trim((string) ($validated['content'] ?? ''));

        DB::table('posts')->where('id', $postId)->update([
            'content' => $content,
            'updated_at' => now(),
        ]);

        return redirect()->route('student.community');
    }

    public function destroy(Request $request, int $postId)
    {
        $email = strtolower(trim((string) $request->session()->get('email', '')));
        if ($email === '') {
            return redirect()->route('student.login');
        }

        $post = DB::table('posts')->where('id', $postId)->first();
        if (!$post) {
            return redirect()->route('student.community');
        }

        $postEmail = strtolower(trim((string) ($post->email ?? '')));
        if ($postEmail !== $email) {
            abort(Response::HTTP_FORBIDDEN);
        }

        DB::table('comments')->where('post_id', $postId)->delete();
        DB::table('posts')->where('id', $postId)->delete();

        return redirect()->route('student.community');
    }
}
