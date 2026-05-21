<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    // QUIZ LIST
    public function index()
    {
        $quizzes = DB::table('quizzes')->get();

        return view('quizzes', compact('quizzes'));
    }

    // START QUIZ
    public function start($id)
    {
        $quiz = DB::table('quizzes')
            ->where('id', $id)
            ->first();

        $questions = DB::table('questions')
            ->where('quiz_id', $id)
            ->get();

        return view(
            'quiz-start',
            compact('quiz', 'questions')
        );
    }

    // SUBMIT QUIZ
    public function submit(Request $request, $id)
    {
        $questions = DB::table('questions')
            ->where('quiz_id', $id)
            ->get();

        $score = 0;

        $correct = 0;

        $wrong = 0;

        $mistakes = [];

        foreach ($questions as $question) {

            $answer =
            $request->input(
                'question_' . $question->id
            );

            if ($answer == $question->correct_answer) {

                $score += 10;

                $correct++;

            } else {

                $wrong++;

                $mistakes[] = [

                    'question' =>
                    $question->question,

                    'your_answer' =>
                    $answer,

                    'correct_answer' =>
                    $question->correct_answer,

                    'explanation' =>
                    $question->explanation

                ];
            }
        }

        DB::table('quiz_results')->insert([

            'student_id' => 1,
            'quiz_id' => $id,
            'score' => $score,
            'correct_answers' => $correct,
            'wrong_answers' => $wrong

        ]);

        return view(
            'quiz-result',
            compact(
                'score',
                'correct',
                'wrong',
                'mistakes'
            )
        );
    }
}