<?php

namespace App\Http\Controllers;

use App\Training;
use App\Section;
use App\Lecture;
use App\Test;
use App\UserTest;
use App\User;
use App\EnrolledTrainings;
use App\Certificate;
use App\SuggestedTrainings;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

use Nexmo\Laravel\Facade\Nexmo;

use App\Notifications\CreatedTraining;

use File;
use DB;


class TrainingController extends Controller
{
    /* 
        INDEX FUNCTIONS
    */
    public function getTrainings() {
        $trainings = Training::orderBy('updated_at', 'desc')->get();
        return response()->json($trainings);
    }

    public function getSections($id) {
        $sections = Section::where('training_id', '=', $id)->orderBy('index', 'asc')->get();
        return response()->json($sections);
    }

    public function getLectures($section) {
        $lectures = Lecture::where('section_id', '=', $section)->with(['test'])->get();
        return response()->json($lectures);
    }

    /* 
        STORE FUNCTIONS
    */
    public function storeTraining(Request $request) {
        $validateData = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|file|image|max:4000',
            'duration' => 'required',
            'completion' => 'required',
            'skills'=>'nullable',
        ], $messages = [
            'required' => 'This field is required.',
            'image' => 'Invalid file format. Please select an image file'
        ]);

        $training = new Training();
        $training->title = $validateData['title'];
        $training->description = $request->description;
        $training->duration = $validateData['duration'];
        $training->completion = $validateData['completion'];
        $validateData['skills']= $request->skills;
        $training->skills = $validateData['skills'];

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            // Old config. Outputs double extension
            // $filename = $file->getClientOriginalName().time().'.'.$extension;
            $randomFilename = Str::random(20);
            $filename = $randomFilename.'.'.$extension;
            $destinationPath = public_path('storage/trainings/');
            $file->move($destinationPath, $filename);
            $training->image = $filename;
        }

        if($request->has('suggested')) {
            $training->suggested_training_id = $request->suggested;
        }
        // File::deleteDirectory(public_path('/storage'));
        $training->save();
        $this->storeCertificate($training->id, $request->user);
        return response()->json($training);
    }

    public function storeCertificate($id, $userID) {
        $user = User::find($userID);
        if($user->isHR) {
            $hr = $user;
            $admin = User::where('isAdmin', true)->first();
        } else {
            $hr = User::where('isHR', true)->first();
            $admin = $user;
        }
        Certificate::create([
            'hr' => $hr->fname.' '.$hr->lname,
            'admin' => $admin->fname.' '.$admin->lname,
            'training_id' => $id
        ]);
    }

    public function markSuggested($id) {
        $request = SuggestedTrainings::find($id);
        $request->is_created = true;
        $request->update();
        $user = User::find($request->user_id);
        $data = [
            'message' => $request->title.' is now published.'
        ];
        $user->notify(new CreatedTraining($data));
    }

    public function storeSection(Request $request) {
        $validateData = $request->validate([
            'title' => 'required',
            'training_id' => 'required'
        ]);

        $section = new Section();
        $section->title = $validateData['title'];
        $section->training_id = $validateData['training_id'];
        $lastIndex = Section::where('training_id', '=', $validateData['training_id'])->get()->pluck('index')->last();
        $section->index = $lastIndex + 1;
        $section->save();

        return $this->getSections($section->training_id);
        // Return an Array of sections with their training ID
    }

    public function storeLecture(Request $request) {
        $validateData = $request->validate([
            'title' => 'required|string',
            'section_id' => 'required|numeric',
            'isTest' => 'required|boolean',
        ]);

        $lecture = new Lecture();
        $lecture->title = $validateData['title'];
        $lecture->section_id = $validateData['section_id'];
        $lecture->isTest = $validateData['isTest'];
        $lastIndex = Lecture::where('section_id', '=', $validateData['section_id'])->get()->pluck('index')->last();
        $lecture->index = $lastIndex + 1;
        $lecture->save();

        // Create a new Test instance
        if ($validateData['isTest'] != false) {
            Test::create([
                'lecture_id' => $lecture->id
            ]);
        }

        return $this->getLectures($lecture->section_id);
        // Return an Array of lectures with their section ID 
    }

    public function storeLectureContent(Request $request, $id) {
        $validateData = $request->validate([
            'content' => 'string',
        ]);

        $lecture = Lecture::findOrFail($id);
        $lecture->content = $request->content;
        $lecture->save();
        
        return response()->json($lecture);
    }

    /* 
        SHOW FUNCTIONS
    */
    public function showTraining($id) {
        $training = Training::with(['sections.lectures'])->findOrFail($id);
        return response()->json($training);
    }

    public function showSection($training, $section) {
        // $section = Section::where('training_id', '=', $training)->findOrFail($section);
        // $lectures = $this->getLectures($section->id);
        // return response()->json(['section' => $section, 'lectures' => $lectures]);
        $section = Section::with(['training'])->findOrFail($section);
        $lectures = Lecture::where('section_id', '=', $section->id)->with(['test'])->get();
        return response()->json(['section' => $section, 'lectures' => $lectures]);
    }

    public function showLecture($training, $section, $lecture) {
        $getLecture = Lecture::findOrFail($lecture);
        return response()->json($getLecture);
    }

    public function getHRs() {
        $users = User::where('isHR', '=', true)->get();
        return response()->json($users);
    }

    public function getAdmins() {
        $users = User::where('isAdmin', '=', true)->get();
        return response()->json($users);
    }
    
    /* 
        UPDATE FUNCTIONS
    */
    public function updateTraining(Request $request, $id) {
        if($request->hasFile('image')) {
            $validate = $request->validate([
                'title' => 'required',
                'description' => 'nullable',
                'image' => 'nullable|file|image|max:4000',
                'duration' => 'required',
                'completion' => 'required',
                'skills' => 'required'
            ], $messages = [
                'required' => 'This field is required.'
            ]);
        }
        
        $validate = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration' => 'required',
            'completion' => 'required',
            'skills' => 'required'
        ], $messages = [
            'required' => 'This field is required.'
        ]);

        $training = Training::find($id);
        $training->title = $validate['title'];
        $training->description = $validate['description'] ? $validate['description'] : '';
        $training->duration = $validate['duration'];
        $training->completion = $validate['completion'];
        $training->skills = $validate['skills'];

        if($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $randomFilename = Str::random(12);
                $filename = $randomFilename.'.'.$extension;
                $destinationPath = public_path('storage/trainings/');
                $file->move($destinationPath, $filename);
                $training->image = $filename;
            }
        }

        $training->save();
        return response()->json($training);
    }

    public function addStep(Training $training) {
        $training->step += 1;
        $training->update();
    }

    public function subStep(Training $training) {
        $training->step -= 1;
        $training->update();
    }

    public function finalizeTraining(Training $training) {
        $training->isFinal = true;
        if($training->suggested_training_id != null) {
            $this->markSuggested($training->suggested_training_id);
        }
        $training->update();
    }

    public function changeSectionTitle(Section $section, Request $request) {
        $section->title = $request->title;
        $section->update();
        return $this->getSections($section->training_id);
    }

    public function changeLectureTitle(Lecture $lecture, Request $request) {
        $lecture->title = $request->title;
        $lecture->update();
        return $this->getLectures($lecture->section_id);
    }

    public function changeSectionOrder($training, $section, $source, $destination) {
        $src = Section::where([['training_id', '=', $training],['index', '=', $source]])->first();
        $des = Section::where([['training_id', '=', $training],['index', '=', $destination]])->first();
        $src->index = $destination;
        $src->save();
        $des->index = $source;
        $des->save();
        // $src->update(['index' => $destination]);
        // $des->update(['index' => $source]);
        // return response()->json([$training, $section, $source, $destination]);
        return $this->getSections($training);
    }

    public function archive(Training $training) {
        $training->archived = $training->archived == true ? false : true;
        $training->update();
        return response()->json('Training updated!', 200);
    }


    /* 
        ENROLL FUNCTIONS
    */
    public function enrollTraining(Request $req) {
        $req->validate([
            'user_id' => 'required',
            'training_id' => 'required', 
        ]);
        
        $enrolltraining = new EnrolledTrainings;
        $enrolltraining->user_id = $req->user_id;
        $enrolltraining->training_id = $req->training_id;

        $user = User::find($enrolltraining->user_id);
        $training = Training::find($enrolltraining->training_id);
        $expiration = new Carbon();
        $expiration->addDays($training->duration);

        $noErrors = $this->hasEnrolledSMS($user->contact, $training->title, $expiration->toFormattedDateString());
        
        if($noErrors == true) {
            $enrolltraining->save();
            return response()->json(200);
        } else {
            return response()->json(500);
        }

        // return response()->json('no error');
    }
    
    /*  
        Get all enrolled trainings of a certain user
        $id = User's ID
    */
    public function getEnrolledTrainings($id) {
        $enrolledTrainings = EnrolledTrainings::where('user_id', '=', $id)->with(['training','user'])->get();
        return response()->json($enrolledTrainings);
    }
    
    /* 
        Get the certain training progress of a user
        $user = User's ID
        $training = Training ID
    */
    public function getTrainingProgress($id, $user) {
        // $enrolledTraining = EnrolledTrainings::where([
        //     [
        //         'id', '=', $id
        //     ],
        //     [
        //         'user_id', '=', $user
        //     ]
        // ])->with([
        //     // 'training.sections.lectures.test'
        //     'training.sections'
        // ])->first();

        $enrolledTraining = EnrolledTrainings::where('user_id', '=', $user)->with([
        // $enrolledTraining = EnrolledTrainings::where('id', $id)->with([
            'training.sections.lectures.test.questions',
            'user'
            // 'training.sections'
        ])->findOrFail($id);
        return response()->json($enrolledTraining);
    }

    public function updateCurrent(Request $request) {
        $request->validate([
            'id' => 'required',
            'finished' => 'nullable',
            'current' => 'required'
        ]);

        $data = EnrolledTrainings::where('id', '=', $request->id)->first();
        $data->current = json_encode($request->all());
        $data->save();

        return $this->getTrainingProgress($data->id, $data->user_id);
        // return response()->json($data);
        // return $request;
    }

    public function getOverallProgress(Request $request, $id) {
        $count = 0;
        $enrolled = EnrolledTrainings::where('id', '=', $id)->with(['training.sections.lectures', 'user'])->first();
        foreach($enrolled->training->sections as $section) {
            $count += collect($section->lectures)->count();
        }
        $finished = collect($request)->count();
        $progress = ($finished / $count) * 100;
        $enrolled->progress = $progress;
        $enrolled->update();

    //    return $this->getTrainingProgress($enrolled->id, $enrolled->user_id);
        // return response()->json($request);
        return response()->json($enrolled);
    }

    public function finishedTraining($enrolled) {
        $now = Carbon::now();
        $training = EnrolledTrainings::where('id', '=', $enrolled);
        $training->update([
            'date_completed' => $now->toDateTimeString(),
            'is_completed' => true
        ]);
        return response()->json($training);
    }

    public function hasEnrolledSMS($contact, $title, $exp) {
        // , $exp
        Nexmo::message()->send([
            'to'   => '63'.$contact,
            'from' => '16105552344',
            'text' => 'You have enrolled to the training: '.$title.'. Please finish the training on or before '.$exp.'.'
        ]);
        return true;
    }

    /* 
        DELETE FUNCTIONS
    */
    public function sectionDelete(Section $section) {
        $trainingID = $section->training_id;
        $section->delete();
        return $this->getSections($trainingID);
    }

    public function lectureDelete(Lecture $lecture) {
        $sectionID = $lecture->section_id;
        $lecture->delete();
        return $this->getLectures($sectionID);
    }

    public function graph() {
        // gets the training titles
        $trainings = Training::where('trainings.archived', '=', false)->select('title')->get();

        // must count the number of training titles
        $enrolled = DB::table('enrolled_trainings')
                    ->join('trainings', 'enrolled_trainings.training_id', '=', 'trainings.id')
                    ->join('users', 'enrolled_trainings.user_id', '=', 'users.id')
                    ->where('trainings.archived', '=', false)
                    ->select('trainings.title', 'enrolled_trainings.id')->get();

        $isFinished = DB::table('enrolled_trainings')
                    ->where('is_completed', '=', true)
                    ->join('trainings', 'enrolled_trainings.training_id', '=', 'trainings.id')
                    ->where('trainings.archived', '=', false)
                    ->select('trainings.title')->get();

        $unfinished = DB::table('enrolled_trainings')
                    ->where('is_completed', '=', false)
                    ->join('trainings', 'enrolled_trainings.training_id', '=', 'trainings.id')
                    ->where('trainings.archived', '=', false)
                    ->select('trainings.title')->get();

        $testIds = Test::get('id');

        // $enrolledIds = EnrolledTrainings::with('training')->where('enrolled_trainings.is_completed', '=', true)->get();
        $passed = $this->passedUsers($trainings, $isFinished);

        $userTests = DB::table('user_tests')
                    ->join('tests', 'user_tests.test_id', '=', 'tests.id')
                    ->join('enrolled_trainings', 'enrolled_trainings.id', '=', 'user_tests.enrolled_training_id')
                    ->join('users', 'enrolled_trainings.user_id', '=', 'users.id')
                    ->join('trainings', 'enrolled_trainings.training_id', '=', 'trainings.id')
                    ->where([['trainings.archived', '=', false], ['enrolled_trainings.is_completed', '=', true]])
                    ->select('trainings.title',  'trainings.id as training_id', 'enrolled_trainings.id as enrolled_id', 'tests.total_score', 'user_tests.score', 'tests.id as test_id')->get();

        // $getTests = DB::table('user_tests')
        //             ->join('tests', 'user_tests.test_id', '=', 'tests.id')
        //             ->join('enrolled_trainings', 'enrolled_trainings.id', '=', 'user_tests.enrolled_training_id')
        //             ->join('trainings', 'enrolled_trainings.training_id', '=', 'trainings.id')
        //             ->where([['trainings.archived', '=', false], ['enrolled_trainings.is_completed', '=', true]])
        //             ->select('trainings.id as training_id', 'tests.total_score')->get();
        
        $getTotalScores = $this->getTotalScores();
        $getHighest = $this->getHighest($userTests, $enrolled);
        // $getLowest = $this->getLowest($userTests, $enrolled);

        $failed = DB::table('faileds')
                    ->join('enrolled_trainings', 'faileds.enrolled_trainings_id', '=', 'enrolled_trainings.id')
                    ->join('trainings', 'trainings.id', '=', 'enrolled_trainings.training_id')
                    ->where([['trainings.archived', '=', false], ['enrolled_trainings.is_completed', '=', true]])
                    ->select('trainings.title')->get();

        // dd($getHighest);
        return response()->json([
            'titles' => $trainings, 
            'summary' => [
                'enrolled' => $enrolled,
                'finished' => $isFinished,
                'unfinished' => $unfinished
            ], 
            'user_test' => [
                'average' => $userTests,
                'highest' => $getHighest,
                'total_scores' => $getTotalScores
            ], 
            'failed' => $failed,
            'passed' => $passed
        ]);
    }

    public function passedUsers($trainings, $enrolls) {
        $data = [];
        foreach($trainings as $training) {
            $counter = 0;
            foreach($enrolls as $enroll) {
                if($enroll->title == $training->title) {
                    $counter++;
                }
            }
            array_push($data, ['title' => $training->title, 'count' => $counter]);
            // array_push($data, [$counter]);
        }
        return $data;
    }

    public function getHighest($results, $enrolled) {
        $arr = [];
        $user_id = null;        
        $trainings = Training::where('trainings.archived', '=', false)->select('id', 'title')->get();
        foreach($trainings as $training) {
            foreach($enrolled as $enroll) {
            	$highest = 0;
            	$score = 0;
            	$total = 0;
                foreach($results as $result) {
                    if(($result->title == $training->title) && ($enroll->id == $result->enrolled_id)) {
                        $score += $result->score;
                        $total += $result->total_score;
                    }
                }
                $highest = $highest < $score ? ($score/$total) * 100 : $highest; 
            }
            // array_push($arr, [
            //     $training->title => $highest
            // ]);
            array_push($arr, round($highest, 2));
        }
        // return ['data' => $arr, 'enrolled' => $enrolled, 'results' => $results];
        return $arr;
    }

    // public function getLowest($results, $enrolled) {
    //     $arr = [];
    //     $user_id = null;
    //     $trainings = Training::where('trainings.archived', '=', false)->select('id', 'title')->get();
    //     foreach($trainings as $training) {
    //         $score = 0;
    //         $total = 0;
    //         $lowest = null;
    //         foreach($enrolled as $enroll) {
    //             foreach($results as $result) {
    //                 if(($result->title == $training->title) && ($enroll->id == $result->enrolled_id)) {
    //                     $score += $result->score;
    //                     $total += $result->total_score;
    //                 }
    //             }
    //             // $lowest = $lowest < $score ? ($score/$total) * 100: $lowest ;
    //             $lowest = $score;
    //         }
    //         array_push($arr, [
    //             $training->title => $lowest
    //         ]);
    //     }
    //     // return ['data' => $arr, 'results' => $results, 'enrolled' => $enrolled, 'trainings' => $trainings];
    //     return $arr;
    // }

    public function getTotalScores() {
        $arr = [];
        $trainings = Training::where('trainings.archived', '=', false)->get();
        $tests = Test::with(['lecture.section.training'])->get();
        foreach($trainings as $training) {
            $scoreCounter = 0;
            foreach($tests as $test) {
                if ($test->lecture->section->training->id == $training->id) {
                    $scoreCounter += $test->total_score;
                }
            }
            if($scoreCounter != 0) {
                array_push($arr, ['title' => $training->title, 'total_score' => $scoreCounter]);
            }
        }
        return $arr;
    }

    public function getAllEnrolled($training) {
        $enrolled = EnrolledTrainings::with('user')->where('training_id', '=', $training)->get();
        return response()->json($enrolled);
    }

    public function addImage(Request $request) {
        $request->validate([
            'image' => 'file|image|max:4000'
        ]);
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            // Old config. Outputs double extension
            // $filename = $file->getClientOriginalName().time().'.'.$extension;
            $randomFilename = Str::random(20);
            $filename = $randomFilename.'.'.$extension;
            $destinationPath = public_path('storage/trainings/assets');
            $file->move($destinationPath, $filename);
            return response()->json('/storage/trainings/assets/'.$filename);
        }
    }
}
