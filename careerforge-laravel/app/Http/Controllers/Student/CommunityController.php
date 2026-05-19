<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunityController extends Controller
{
    public function show(Request $request)
    {
        $normalizeEmail = static fn ($value): string => strtolower(trim((string) $value));

        $email = $normalizeEmail($request->session()->get('email', ''));
        $user = null;

        if ($email !== '') {
            $user = DB::table('students')
                ->whereRaw('LOWER(TRIM(email)) = ?', [$email])
                ->first();
        }

        $posts = DB::table('posts')
            ->orderByDesc('id')
            ->limit(50)
            ->get();

        $postIds = $posts->pluck('id')->all();

        $commentsByPost = [];
        $commentEmails = [];

        if (!empty($postIds)) {
            $comments = DB::table('comments')
                ->whereIn('post_id', $postIds)
                ->orderBy('id')
                ->get();

            foreach ($comments as $comment) {
                $postId = (int) $comment->post_id;
                if (!isset($commentsByPost[$postId])) {
                    $commentsByPost[$postId] = [];
                }
                $commentsByPost[$postId][] = $comment;

                if (!empty($comment->email)) {
                    $commentEmails[] = $normalizeEmail($comment->email);
                }
            }
        }

        $postEmails = $posts
            ->pluck('email')
            ->map($normalizeEmail)
            ->filter(fn ($e) => $e !== '')
            ->all();

        $emails = array_values(array_unique(array_filter(array_merge($postEmails, $commentEmails))));

        $authorsByEmail = [];
        if (!empty($emails)) {
            $authors = DB::table('students')
                ->select(['email', 'name', 'image'])
                ->whereIn(DB::raw('LOWER(TRIM(email))'), $emails)
                ->get();

            foreach ($authors as $author) {
                $imageSrc = asset('assets/user.png');
                $rawImage = (string) ($author->image ?? '');
                if ($rawImage !== '') {
                    if (str_starts_with($rawImage, 'uploads/')) {
                        $imageSrc = asset($rawImage);
                    } else {
                        $imageSrc = $rawImage;
                    }
                }

                $authorsByEmail[$normalizeEmail($author->email)] = [
                    'name' => (string) ($author->name ?? ''),
                    'imageSrc' => $imageSrc,
                ];
            }
        }

        return view('student.community', [
            'user' => $user,
            'loggedIn' => $email !== '',
            'posts' => $posts,
            'commentsByPost' => $commentsByPost,
            'authorsByEmail' => $authorsByEmail,
        ]);
    }
}
