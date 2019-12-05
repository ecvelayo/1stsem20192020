<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* INDEX */
Route::get('/trainings', 'TrainingController@getTrainings');
Route::get('/training/{id}/sections', 'TrainingController@getSections');
// Route::get('/training/{training}/section/{section}', 'TrainingController@getLectures');
Route::get('/lecture/{lecture}/test', 'QuestionController@getTest');
Route::get('/test/{test}', 'QuestionController@getQuestions');
Route::get('/users', 'UserController@getAllUsers');
Route::get('/get/user/{id}', 'UserController@getUser');
// Route::get('/get/usertrainings{id}', 'UserController@getUserTrainings');
Route::get('/get/userprofile/{id}', 'UserController@getUserProfile');
Route::get('/all/notifications/{id}', 'NotificationsController@getAllNotifications');
Route::get('/get/requests', 'SuggestedTrainingsController@requests');

/* SHOW */
Route::get('/training/{id}', 'TrainingController@showTraining');
Route::get('/training/{training}/section/{section}', 'TrainingController@showSection');
Route::get('/training/{training}/section/{section}/lecture/{lecture}', 'TrainingController@showLecture');
// Route::get('/enrolled/training/{id}','TrainingController@getEnrolledTrainings');
Route::get('/answers/enrolled/{enrolled}/lecture/{lecture}', 'AnswerController@getAnswers');
Route::get('/test/enrolled/{enrolled}/lecture/{lecture}/checked', 'AnswerController@isChecked');
Route::get('/get/hrs', 'TrainingController@getHRs');
Route::get('/get/admins', 'TrainingController@getAdmins');
Route::get('/get/certificate/{id}', 'CertificateController@getCertificate');
Route::get('/test/{lecture}/passing', 'QuestionController@getPassingRate');
Route::get('/get/enrolled/{training}', 'TrainingController@getAllEnrolled');
Route::get('/notifications/{id}', 'NotificationsController@getUserUnreadNotifications');

/* EDIT */
Route::get('/edit/training/{id}', 'TrainingController@showTraining');
Route::get('/edit/training/{id}/section/{section}', 'TrainingController@showSection');
Route::get('/announcements', 'AnnouncementController@getAnnouncements');
Route::get('/archive/users', 'UserController@getAllInactive');

/* CREATE */
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::post('/trainings', 'TrainingController@storeTraining');
Route::post('/sections', 'TrainingController@storeSection');
Route::post('/lectures', 'TrainingController@storeLecture');
Route::post('/lecture/content/{id}', 'TrainingController@storeLectureContent');
Route::post('/test', 'QuestionController@store');
Route::post('/announcements', 'AnnouncementController@storeAnnouncement');
Route::post('/createuser', 'UserController@create');
Route::post('/submit/answer', 'AnswerController@submit');
Route::post('/suggested', 'SuggestedTrainingsController@store');
Route::post('/add/image', 'TrainingController@addImage');
Route::post('/add/video', 'TrainingController@addVideo');

/* UPDATE */
Route::post('/edit/training/{id}', 'TrainingController@updateTraining');
Route::put('/update/training/add/step/{training}', 'TrainingController@addStep');
Route::put('/update/training/sub/step/{training}', 'TrainingController@subStep');
Route::put('/update/training/finalize/{training}', 'TrainingController@finalizeTraining');
Route::post('/progress/update', 'TrainingController@updateCurrent');
Route::put('/update/user/{id}', 'UserController@updateUser');
Route::put('/update/user/{user}/admin', 'UserController@adminUpdateUser');
Route::post('/update/user/image/{user}', 'UserController@updateUserPicture');
Route::put('/update/user/password/{user}', 'UserController@resetPass');
Route::put('/update/user/password/{user}/admin', 'UserController@adminResetPass');
Route::put('/archive/user/{user}', 'UserController@archive');
Route::put('/unarchive/user/{user}', 'UserController@unArchive');
Route::put('/update/userprofile/{id}', 'UserController@editProfile');
Route::put('/finished/{enrolled}', 'TrainingController@finishedTraining');
Route::put('/enrolled/training/{id}/total','TrainingController@getOverallProgress');
Route::put('/update/certificate/{certificate}', 'CertificateController@update');
Route::post('/add/certificate/image/{certificate}', 'CertificateController@addImage');
Route::put('/change/section/{section}', 'TrainingController@changeSectionTitle');
Route::put('/training/{training}/section/{section}/{source}/{destination}', 'TrainingController@changeSectionOrder');
Route::put('/test/{test}/passing', 'QuestionController@setPassingRate');
Route::put('/change/lecture/{lecture}', 'TrainingController@changeLectureTitle');
Route::get('/read/notification/{notif}/user/{id}', 'NotificationsController@markAsRead');
Route::put('/archive/training/{training}', 'TrainingController@archive');

/* ENROLL */
Route::post('/training/enroll', 'TrainingController@enrollTraining');
Route::get('/enrolled/trainings/{id}','TrainingController@getEnrolledTrainings');
Route::get('/progress/enrolled/{id}/user/{user}', 'TrainingController@getTrainingProgress');

/* DELETE */
Route::delete('/user/delete/{id}', 'UserController@deleteUser');
Route::delete('/section/delete/{section}', 'TrainingController@sectionDelete');
Route::delete('/lecture/delete/{lecture}', 'TrainingController@lectureDelete');

Route::get('/get/graph', 'TrainingController@graph');
Route::post('/submit/failed', 'AnswerController@hasFailed');
Route::get('/get/failed', 'AnswerController@getFailed');