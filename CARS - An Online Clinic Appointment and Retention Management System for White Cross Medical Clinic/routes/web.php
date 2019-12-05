<?php

use App\Events\AppointmentStatus;
use App\Events\PatientStaff;
use App\User;
use App\Notifications\EmailNotification;

Route::get('/', 'HomeController@index')->name('home');

Route::post('results/search', 'ResultController@patientResults')->name('results.patientResults');
Route::post('results', 'ResultController@store')->name('results.store');
Route::get('results/{id}', 'ResultController@show')->name('results.show');
Route::post('results/update/{id}', 'ResultController@update')->name('results.update');
Route::post('results/destroy/{id}', 'ResultController@destroy')->name('results.destroy');
Route::post('results/restore/{id}', 'ResultController@restore')->name('results.restore');
// Route::resource('results', 'ResultController');

Route::group(['middleware' => 'preventBackHistory'], function() {
    
    Auth::routes();

    Route::group(['middleware' => 'auth'], function () {
        
        Route::post('/ChangePassword', 'ChangePasswordController@changePassword')->name('ChangePassword');
        Route::post('getMedicalHistory', 'PatientRecordController@getMedicalHistory')->name('getMedicalHistory');
        Route::post('getVitalSigns', 'PatientRecordController@getVitalSigns')->name('getVitalSigns');
        Route::post('updateMedicalHistory', 'PatientRecordController@updateMedicalHistory')->name('updateMedicalHistory');
        Route::post('updateVitalSign', 'PatientRecordController@updateVitalSign')->name('updateVitalSign');
        Route::post('storeMedicalHistory', 'PatientRecordController@storeMedicalHistory')->name('storeMedicalHistory');
        Route::post('storeVitalSigns', 'PatientRecordController@storeVitalSigns')->name('storeVitalSigns');
        Route::post('deleteMedicalHistory', 'PatientRecordController@deleteMedicalHistory')->name('deleteMedicalHistory');
        Route::post('deleteVitalSign', 'PatientRecordController@deleteVitalSign')->name('deleteVitalSign');
        Route::post('restoreMedicalHistory', 'PatientRecordController@restoreMedicalHistory')->name('restoreMedicalHistory');
        Route::post('restoreVitalSign', 'PatientRecordController@restoreVitalSign')->name('restoreVitalSign');
        Route::post('getDocSchedules', 'AppointmentController@getDocSchedules')->name('appointment.getDocSchedules');
        Route::post('resultsForPatient', 'ResultController@resultsForPatient')->name('patient.resultsForPatient');

        Route::post('notify/getNotifications', 'NotificationController@getNotifications')->name('notify.getNotifications');
        Route::post('notify/storeNotifications', 'NotificationController@storeNotifications')->name('notify.storeNotifications');
        Route::get('notify/seenNotifications', 'NotificationController@seenNotifications')->name('notify.seenNotifications');
        Route::get('appointment/todaystaff', 'AppointmentController@todaystaff');
        Route::get('appointment/requeststaff', 'AppointmentController@patientrequeststaff');
        Route::get('appointment/countstaff', 'AppointmentController@patientcountstaff');

        Route::get('appointment/today', 'AppointmentController@today');
        Route::get('appointment/request', 'AppointmentController@patientrequest');
        Route::get('appointment/count', 'AppointmentController@patientcount');


        // ADMIN ROUTES
        Route::group(['middleware' => 'role:ADMIN'], function () {
            Route::get('admin/dashboard/{name}', 'AdminPageController@dashboard')->name('admin.dashboard');
            Route::get('admin/appointments/{name}', 'AdminPageController@appointment')->name('admin.appointment');
            Route::get('admin/user_mgt/{name}', 'AdminPageController@user_mgt')->name('admin.user_mgt');
            Route::get('admin/doc_schedule/{name}', 'AdminPageController@doc_schedule')->name('admin.schedule');
            Route::get('admin/bill_payments/{name}', 'AdminPageController@billing')->name('admin.billing');
            Route::get('admin/messages/{name}', 'AdminPageController@message')->name('admin.message');
            Route::get('admin/settings/{name}', 'AdminPageController@setting')->name('admin.setting');
            Route::get('admin/services/{name}', 'AdminPageController@service')->name('admin.services');
            Route::get('admin/patient_records/{name}', 'AdminPageController@patient_records')->name('admin.patient_records');
            Route::get('admin/results/{name}', 'AdminPageController@results')->name('admin.results');

            Route::get('admin_service/restore/{id}', 'Admin_ServiceController@restore')->name('admin_service.restore');
            Route::resource('admin_service', 'Admin_ServiceController');
            Route::post('/restore/{id}', 'Admin_UserMGTController@restore')->name('admin_usermgt.restore');
            Route::resource('admin_usermgt', 'Admin_UserMGTController');
            Route::resource('doctor_schedule', 'DoctorSchedController');
            Route::post('doctor_schedule/restore/{id}', 'DoctorSchedController@restore')->name('doctor_schedule.restore');
        });

        // PATIENT ROUTES
        Route::group(['middleware' => 'role:PATIENT'], function () {
            Route::get('patient/appointments/{name}', 'PatientPageController@appointments')->name('patient.appointments');
            Route::get('patient/billing/{name}', 'PatientPageController@billing')->name('patient.billing');
            Route::post('patient/billing', 'BillingController@getPatientBilling')->name('patient.getPatientBilling');
            Route::get('patient/results/{name}', 'PatientPageController@results')->name('patient.results');
            Route::get('patient/settings/{name}', 'PatientPageController@settings')->name('patient.settings');
            Route::post('patient/UpdateSettings', 'PatientPageController@UpdateSettings')->name('patient.UpdateSettings');
            Route::get('patient/getPatientAppointments', 'AppointmentController@getPatientAppointments')->name('patient.getPatientAppointments');
            Route::get('patient/getPatientApproved', 'AppointmentController@getPatientApproved')->name('patient.getPatientApproved');
            Route::post('patient/requestAppointment', 'AppointmentController@requestAppointment')->name('patient.requestAppointment');
        });
        
        // NURSE ROUTES
        Route::group(['middleware' => 'role:NURSE'], function () {
            Route::get('nurse/dashboard/{name}', 'NursePageController@dashboard')->name('nurse.dashboard');
            Route::get('nurse/appointments/{name}', 'NursePageController@appointment')->name('nurse.appointment');
            Route::get('nurse/patient_records/{name}', 'NursePageController@patientRecords')->name('nurse.patient_records');
            Route::post('nurse/patient_records/add_new', 'NursePageController@addPatientRecords')->name('nurse.add_patient_records');
            Route::get('nurse/billing/{name}', 'NursePageController@billing')->name('nurse.billing');
            Route::get('nurse/results/{name}', 'NursePageController@results')->name('nurse.results');
            Route::get('nurse/settings/{name}', 'NursePageController@settings')->name('nurse.settings');
            Route::get('nurse/UpdateSettings', 'NursePageController@UpdateSettings')->name('nurse.UpdateSettings');
        });

        // ADMIN & NURSE ROUTES
        Route::group(['middleware' => ['role:NURSE,ADMIN']], function () {
            Route::post('getAppointments', 'AppointmentController@getAppointments')->name('appointment.getAppointments');
            Route::post('getApprovedAppointments', 'AppointmentController@getApprovedAppointments')->name('appointment.getApprovedAppointments');
            Route::post('approve/{id}', 'AppointmentController@approve')->name('appointment.approve');
            Route::post('done/{id}', 'AppointmentController@done')->name('appointment.done');
            Route::post('ongoing/{id}', 'AppointmentController@ongoing')->name('appointment.ongoing');
            Route::post('cancel/{id}', 'AppointmentController@cancel')->name('appointment.cancel');
            Route::post('reschedule', 'AppointmentController@reschedule')->name('appointment.reschedule');
            Route::resource('appointment', 'AppointmentController');
            Route::post('billing/store', 'BillingController@store')->name('billing.store');
            Route::post('billing/getMedicalService', 'BillingController@getMedicalService')->name('billing.getMedicalService');
            Route::post('billing/destroy', 'BillingController@destroy')->name('billing.destroy');
            Route::post('billing/restore', 'BillingController@restore')->name('billing.restore');
            Route::post('billing/search', 'BillingController@getBilling')->name('billing.getBilling');
        });

        // DOCTOR ROUTES
        Route::group(['middleware' => 'role:DOCTOR'], function () {
            Route::get('doctor/dashboard/{name}', 'DoctorPageController@dashboard')->name('doctor.dashboard');
            Route::get('doctor/appointments/{name}', 'DoctorPageController@appointments')->name('doctor.appointments');
            Route::get('doctor/patient_records/{name}', 'DoctorPageController@patientRecords')->name('doctor.patient_records');
            Route::get('doctor/settings/{name}', 'DoctorPageController@settings')->name('doctor.settings');
            Route::get('doctor/getPatient/{id}', 'AppointmentController@getPatient')->name('doctor.getPatient');
        });

    });

});

// Route::get('/fire', function(){
//     $user = User::find(3)->notify(new EmailNotification);
// });
