<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function index()
    {
        // GET USER
        $user = session('user');

        // SAFETY CHECK
        if (!$user) {

            return "No user found in students table";

        }

        // USER SKILLS
        $userSkills = [];

        if (!empty($user->skills)) {

            $userSkills = explode(
                ',',
                strtolower($user->skills)
            );

        }

        // JOB DATA
        $jobs = [

            [
                'title' => 'Frontend Developer',
                'company' => 'Tech Solutions Ltd.',
                'skills' => ['html', 'css', 'javascript'],
                'location' => 'Remote'
            ],

            [
                'title' => 'Backend Developer',
                'company' => 'CodeWorks',
                'skills' => ['php', 'mysql', 'api'],
                'location' => 'Onsite'
            ],

            [
                'title' => 'Full Stack Developer',
                'company' => 'InnovateX',
                'skills' => ['react', 'node.js', 'mongodb'],
                'location' => 'Hybrid'
            ]

        ];

        // MATCH %
        foreach ($jobs as &$job) {

            $matchCount = count(

                array_intersect(
                    $userSkills,
                    $job['skills']
                )

            );

            $total = count($job['skills']);

            $job['match'] =

                ($total > 0)

                ? round(($matchCount / $total) * 100)

                : 0;
        }

        return view('jobs', [

            'jobs' => $jobs

        ]);
    }
}