<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerformanceController extends Controller
{
    public function index()
    {
        $user = session('user');

        $skills = [];

        if (!empty($user->skills)) {
            $skills = explode(',', $user->skills);
        }

        // Completed assessments
        $completedAssessments = DB::table('quiz_results')
            ->where('student_id', $user->id)
            ->count();

        // Total score
        $totalScore = DB::table('quiz_results')
            ->where('student_id', $user->id)
            ->sum('score');

        // Average score
        $averageScore = 0;

        if ($completedAssessments > 0) {
            $averageScore = round($totalScore / $completedAssessments);
        }

        // Overall progress
        $overallProgress = min($averageScore, 100);

        // Career readiness
        $careerReadiness = $overallProgress;

        // Highest score
        $highestScore = DB::table('quiz_results')
            ->where('student_id', $user->id)
            ->max('score');

        // Lowest score
        $lowestScore = DB::table('quiz_results')
            ->where('student_id', $user->id)
            ->min('score');

        // Skill analytics
        $strongestSkill = 'HTML';
        $weakestSkill = 'JavaScript';
        $recommendedSkill = 'React.js';

        // Latest quiz activity
        $latestQuiz = DB::table('quiz_results')
            ->where('student_id', $user->id)
            ->latest()
            ->first();

        return view('performance', compact(
            'user',
            'skills',
            'completedAssessments',
            'overallProgress',
            'latestQuiz',
            'averageScore',
            'highestScore',
            'lowestScore',
            'strongestSkill',
            'weakestSkill',
            'recommendedSkill',
            'careerReadiness'
        ));
    }
}
