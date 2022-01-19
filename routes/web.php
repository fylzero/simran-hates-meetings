<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MissedMeetingController;

Route::get('/', [PageController::class, 'home'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('shame-log', [PageController::class, 'shameLog'])->name('shame-log');
    Route::apiResource('missed-meeting', MissedMeetingController::class)->only(['store', 'destroy']);
});
