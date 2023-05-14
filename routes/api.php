<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Reset;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Nurse\NurseController;
use App\Http\Controllers\Visit\VisitController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\Patienthistory\PatienthistoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/Register', [Register::class, 'create']);
Route::post('/login/{Auth}', [Login::class, 'login']);
Route::post('/logout', [Logout::class, 'logout']);
Route::post('/reset/{Auth}', [Reset::class, 'reset']);
Route::put('/Verify/{Auth}', [Verify::class, 'Verify']);

// **********************admin**************
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/showVisits', [VisitController::class, 'showVisits']);
  
    Route::post('/storeDoctor', [DoctorController::class, 'store']);
    Route::delete('/deleteDoctor/{id}', [DoctorController::class, 'destroy']);
    Route::get('/showDoctorNurses/{id}', [DoctorController::class, 'showDoctorNurses']);
    Route::get('/showDoctors', [DoctorController::class, 'show']);


    
    Route::post('/storeNurse', [NurseController::class, 'store']);
    Route::delete('/deleteNurse/{id}', [NurseController::class, 'destroy']);
    Route::get('/showNurses', [NurseController::class, 'show']);
      


    Route::post('/storeService', [ServiceController::class, 'store']);
    Route::delete('/deleteService/{id}', [ServiceController::class, 'destroy']);
    Route::get('/showServices', [ServiceController::class, 'show']);
    Route::post('/updateService/{id}', [ServiceController::class, 'update']);


    Route::get('/showAllPatientHistory', [PatienthistoryController::class, 'showAllPatientHistory']);
});

// **********************doctor**************
Route::middleware(['auth:sanctum', 'doctor'])->group(function () {
    Route::get('/showDoctorVisits', [VisitController::class, 'showDoctorVisits']);
    Route::post('/storePatientHistory', [PatienthistoryController::class, 'store']);
    Route::get('/showPatienthistoryDoctor/{patientId}', [PatienthistoryController::class, 'showPatienthistoryDoctor']);

});

// **********************nurse**************
Route::middleware(['auth:sanctum', 'nurse'])->group(function () {


});


// **********************patient**************
Route::middleware(['auth:sanctum', 'patient'])->group(function () {
    Route::post('/storeVisit', [VisitController::class, 'store']);
    Route::delete('/deleteVisit/{visitId}', [VisitController::class, 'destroy']);
    Route::get('/showPatientVisits', [VisitController::class, 'showPatientVisits']);
    Route::get('/showPatienthistoryPatient', [PatienthistoryController::class, 'showPatienthistoryPatient']);

});


Route::get('/showDoctorPatient/{doctorId}', [DoctorController::class, 'showDoctorPatient']);
