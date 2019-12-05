<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\UserTest;
use App\Answer;
use App\EnrolledTrainings;
use App\Failed;

class AnswerController extends Controller
{
    public function submit(Request $request) {
        $request->validate([
            'answer' => 'nullable|array',
            'correct' => 'required',
            'enrolled_id' => 'required',
            'lecture_id' => 'required',
        ]);
        $test = $this->getTest($request->lecture_id);
        $enrolled = EnrolledTrainings::find($request->enrolled_id);
        $userTest = UserTest::create([
            'enrolled_training_id' => $enrolled->id,
            'test_id' => $test->id,
            'score' => $request->correct,
            'checked' => true
        ]);
        // if($request->passed == false) {
        //     $this->hasFailed($userTest->id, $enrolled->user->id, $enrolled->id);
        // }
        $this->submitAnswers($request->answer, $userTest->id);
        return response()->json($userTest);
    }

    public function submitAnswers($answers, $userTestId) {
        if(count($answers) > 0) {
            foreach($answers as $answer) {
                $row = Answer::create([
                    'answer' => $answer['answer'],
                    'question_id' => $answer['id'],
                    'user_test_id' => $userTestId
                ]);
            }
        }
    }

    public function getAnswers($enrolled, $lecture) {
        $test = $this->getTest($lecture);
        $userTest = UserTest::where([
            ['enrolled_training_id', '=', $enrolled],
            ['test_id', '=', $test->id]
        ])->first();
        $getUserAnswers = $userTest !== null ?  Answer::where('user_test_id', '=', $userTest->id)->get() : null;
        return $getUserAnswers !== null ?  response()->json($getUserAnswers) : response()->json(null);
    }

    public function getTest($id) {
        $test = Test::where('lecture_id', '=', $id)->first();
        return $test;
    }

    public function isChecked($enrolled, $lecture) {
        $test = $this->getTest($lecture);
        $userTest = UserTest::where([
            ['enrolled_training_id', '=', $enrolled],
            ['test_id', '=', $test->id],
            ['checked', '=', true]
            ])->first(); 
        return response()->json($userTest ? $userTest : false);
    }

    public function hasFailed(Request $request) {
        $failed = Failed::create([
            'enrolled_trainings_id' => $request->enrolled_trainings_id,
        ]);
        return response()->json(200);
    }

    public function getFailed() {
        $failed = Failed::all();
        return response()->json($failed);
    }
}
