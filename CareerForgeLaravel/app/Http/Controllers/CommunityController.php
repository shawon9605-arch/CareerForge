<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunityController extends Controller
{
    // SHOW COMMUNITY PAGE

    public function index()
    {
        $user = session('user');

        if (!$user) {

            return redirect('/login');

        }

        // GET POSTS WITH USER INFO

        $posts = DB::table('community_posts')

            ->join(
                'students',
                'community_posts.student_id',
                '=',
                'students.id'
            )

            ->select(
                'community_posts.*',
                'students.name',
                'students.image'
            )

            ->orderBy(
                'community_posts.id',
                'desc'
            )

            ->get();

        return view('community', [

            'user' => $user,

            'posts' => $posts

        ]);
    }

    // CREATE POST

    public function store(Request $request)
    {
        $user = session('user');

        if (!$user) {

            return redirect('/login');

        }

        DB::table('community_posts')

            ->insert([

                'student_id' =>
                $user->id,

                'content' =>
                $request->content,

                'created_at' =>
                now(),

                'updated_at' =>
                now()

            ]);

        return redirect('/community')

            ->with(
                'success',
                'Post Created Successfully!'
            );
    }

    // LIKE POST

    public function like($id)
    {
        DB::table('community_posts')

            ->where('id', $id)

            ->increment('likes');

        return redirect('/community');
    }

    // COMMENT POST

    public function comment($id)
    {
        DB::table('community_posts')

            ->where('id', $id)

            ->increment('comments');

        return redirect('/community');
    }

    // SHARE POST

    public function share($id)
    {
        DB::table('community_posts')

            ->where('id', $id)

            ->increment('shares');

        return redirect('/community');
    }
}