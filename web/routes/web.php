<?php

use App\Livewire\Dashboard\DashboardCheckIn;
use App\Livewire\Dashboard\DashboardCheckOut;
use App\Livewire\Auth\Login;
use App\Livewire\Employee\CreateEmployee;
use App\Livewire\Employee\EditEmployee;
use App\Livewire\Employee\ListEmployee;
use App\Livewire\Employee\ViewEmployee;
use App\Livewire\Announcement\CreateAnnouncement;
use App\Livewire\Announcement\EditAnnouncement;
use App\Livewire\Announcement\ListAnnouncement;
use App\Livewire\Announcement\ViewAnnouncement;
use App\Livewire\Office\CreateOffice;
use App\Livewire\Office\EditOffice;
use App\Livewire\Office\ListOffice;
use App\Livewire\Office\ViewOffice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Auth
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [Login::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', DashboardCheckIn::class)->name('checkin');
    Route::get('/out', DashboardCheckOut::class)->name('checkout');

    // Employee
    Route::get('/employee', ListEmployee::class)->name('employee');
    Route::get('/employee/create', CreateEmployee::class)->name('employee.create');
    Route::get('/employee/view/{nip}', ViewEmployee::class)->name('employee.view');
    Route::get('/employee/edit/{nip}', EditEmployee::class)->name('employee.edit');

    // Announcement
    Route::get('/announcement', ListAnnouncement::class)->name('announcement');
    Route::get('/announcement/create', CreateAnnouncement::class)->name('announcement.create');
    Route::get('/announcement/view/{slug}', ViewAnnouncement::class)->name('announcement.view');
    Route::get('/announcement/edit/{slug}', EditAnnouncement::class)->name('announcement.edit');

    // Office
    Route::get('/office', ListOffice::class)->name('office');
    Route::get('/office/create', CreateOffice::class)->name('office.create');
    Route::get('/office/view/{slug}', ViewOffice::class)->name('office.view');
    Route::get('/office/edit/{slug}', EditOffice::class)->name('office.edit');
});