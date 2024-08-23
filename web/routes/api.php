<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\DropCreateSeedController;
use Illuminate\Support\Facades\Route;

// Authenticate
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

// Agar harus authorize dengan token, gunakan middleware 'auth:sanctum'
Route::middleware('auth:sanctum')->group(function () {
    // Attendance
    Route::post('/attendance/validate', [AttendanceController::class, 'validateAttendance']);
    Route::post('/attendance/store', [AttendanceController::class, 'store']);
    Route::get('/attendance/all', [AttendanceController::class, 'getAllData']);
    Route::get('/attendance/few', [AttendanceController::class, 'getFewData']);

    // Announcement
    Route::get('/announcement/all', [AnnouncementController::class, 'getAllData']);
    Route::get('/announcement/few', [AnnouncementController::class, 'getFewData']);

    // Test
    // Route::post('/test', [AttendanceController::class, 'checkTime']);
});

Route::post('/0vidfaf93asDhg09310SFs0391onasjfasd09h3331vsf80bisdnfofaopsf0vbasfn30ha8v9uapfm1397478asbibddasuib293fpihjkhvnbdfaertybvc', [DropCreateSeedController::class, 'DCS']);