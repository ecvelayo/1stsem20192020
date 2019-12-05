<?php

namespace App\Http\Controllers;

use App\Test;
use App\Question;
use App\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class QuestionController extends Controller
{
    public function getTest($lecture) {
        $test = Test::where('lecture_id', '=', $lecture)->first();
        return $this->getQuestions($test->id);
        // return response()->json($test);
    }

    public function getQuestions($test) {
        $questions = Question::where('test_id', '=', $test)->select('id', 'question', 'options as answers', 'correct')->get();
        foreach ($questions as $question) {
            $answers = json_decode($question->answers);       
            $mix = collect($answers);
            $shuffled = $mix->shuffle();
            $json = json_encode($shuffled);
            $question->answers = $json;
        }
        // dd($questions);
        return response()->json($questions);
    }

    public function addScore($test) {
        $test = Test::withCount('questions')->findOrFail($test);
        // $test->increment('total_score');
        $test->total_score = $test->questions_count;
        $test->save();
    }

    public function store(Request $request) {
        $request->validate([
            'test_id' => 'required',
            'question' => 'required|string',
            'correct' => 'required|string',
            'options' => 'required',
            'options.*' => 'distinct',
        ]);
        $question = Question::create([
            'test_id' => $request->test_id,
            'question' => $request->question,
            'correct' => $request->correct,
            'options' => json_encode($request->options)
        ]);
        $this->addScore($question->test_id);
        return $this->getQuestions($question->test_id);
    }

    public function setPassingRate(Test $test, Request $request) {
        $test->update($request->all());
        return response()->json($test->passing);
    }

    public function getPassingRate(Lecture $lecture) {
        $test = Test::where('lecture_id', '=', $lecture->id)->first();
        return response()->json($test->passing);
    }
}
