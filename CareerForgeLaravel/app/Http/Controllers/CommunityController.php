<?php

namespace App\Http\Controllers;

class CommunityController extends Controller
{
    public function index()
    {
        // STATIC POSTS
        $posts = [

            [
                'name' => 'Imran',
                'role' => 'Frontend Developer',
                'content' =>
                'Just completed my Laravel profile module 🔥',
                'likes' => 12,
                'comments' => [
                    'Amazing work!',
                    'Looks professional 🔥'
                ]
            ],

            [
                'name' => 'Shawon',
                'role' => 'Backend Developer',
                'content' =>
                'Working on CareerForge community system 😎',
                'likes' => 8,
                'comments' => [
                    'Nice idea!',
                    'Keep going 🚀'
                ]
            ]

        ];

        return view('community', compact('posts'));
    }
}
