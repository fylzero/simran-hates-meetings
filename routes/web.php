<?php

use App\Http\Controllers\MissedMeetingController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('shame-log', [PageController::class, 'shameLog'])->name('shame-log');
    Route::apiResource('missed-meeting', MissedMeetingController::class)->only(['store', 'destroy']);
});
