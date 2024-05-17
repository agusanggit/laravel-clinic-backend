<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Models\DoctorSchedule;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorScheduleController;
use App\Models\ServiceMedicines;
use App\Http\Controllers\Api\ServiceMedicinesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//login
Route::post('/login', [AuthController::class, 'login']);

//logout middleware untuk mendapatkan data dari login yang sudah masuk
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

//doctors middleware menandakan bahwa posisi user untuk doctor harus login dulu
Route::apiResource('/api-doctors', DoctorController::class)->middleware('auth:sanctum');

//patients middleware menandakan bahwa posisi user untuk doctor harus login dulu
Route::apiResource('/api-patients', PatientController::class)->middleware('auth:sanctum');

//doctorschedule middleware menandakan bahwa posisi user untuk doctor harus login dulu
Route::apiResource('/api-doctor-schedule', DoctorScheduleController::class)
->middleware('auth:sanctum');

//service medicines middleware menandakan bahwa posisi user untuk service medicine harus login dulu
Route::apiResource('/api-service-medicines', ServiceMedicinesController::class)
->middleware('auth:sanctum');
