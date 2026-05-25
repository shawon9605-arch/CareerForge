<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $careerReadiness = min(
            ($averageScore + (count($skills) * 5)),
            100
        );

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

        // Smart recommendation
        $recommendation = 'Keep improving your skills 🚀';

        if ($averageScore < 50) {

            $recommendation =
                'Practice more quizzes to improve performance 📚';

        } elseif ($averageScore < 80) {

            $recommendation =
                'You are improving well. Focus on JavaScript 🔥';

        } else {

            $recommendation =
                'Excellent performance! You are career ready 💼';
        }

        // Latest quiz activity
        $latestQuiz = DB::table('quiz_results')
            ->where('student_id', $user->id)
            ->latest()
            ->first();

        // Weekly report
        $weeklyResults = DB::table('quiz_results')
            ->where('student_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->get();

        $weeklyQuizCount = $weeklyResults->count();

        $weeklyAverage = 0;

        if ($weeklyQuizCount > 0) {
            $weeklyAverage = round($weeklyResults->avg('score'));
        }

        // Weekly message
        $weeklyMessage = 'Keep improving your skills!';

        if ($weeklyAverage >= 80) {

            $weeklyMessage =
                'Excellent performance this week! 🔥';

        } elseif ($weeklyAverage >= 60) {

            $weeklyMessage =
                'Good progress, keep learning 🚀';

        } elseif ($weeklyAverage > 0) {

            $weeklyMessage =
                'Practice more to improve performance 📚';
        }

        // Chart data
        $chartLabels = [
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat',
            'Sun'
        ];

        $chartScores = [
            40,
            55,
            60,
            70,
            65,
            80,
            90
        ];

        // Achievement badges

        $badges = [];

        if ($averageScore >= 80) {
            $badges[] = '🏆 Quiz Master';
        }

        if ($completedAssessments >= 5) {
            $badges[] = '🔥 Consistent Learner';
        }

        if (count($skills) >= 3) {
            $badges[] = '🚀 Skill Explorer';
        }

        if ($careerReadiness >= 80) {
            $badges[] = '💼 Career Ready';
        }

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
            'careerReadiness',
            'weeklyQuizCount',
            'weeklyAverage',
            'weeklyMessage',
            'recommendation',
            'chartLabels',
            'chartScores',
            'badges'
        ));
    }

    public function downloadPdf()
    {
        $user = session('user');

        $skills = [];

        if (!empty($user->skills)) {
            $skills = explode(',', $user->skills);
        }

        $completedAssessments = DB::table('quiz_results')
            ->where('student_id', $user->id)
            ->count();

        $averageScore = DB::table('quiz_results')
            ->where('student_id', $user->id)
            ->avg('score');

        $careerReadiness = min(
            (($averageScore ?? 0) + (count($skills) * 5)),
            100
        );

        $pdf = Pdf::loadView(
            'performance-pdf',
            compact(
                'user',
                'skills',
                'completedAssessments',
                'averageScore',
                'careerReadiness'
            )
        );

        return $pdf->download('performance-report.pdf');
    }
}
