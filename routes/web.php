<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MissedMeetingController;
use App\Actions\Impersonation\ImpersonateUserAction;
use App\Actions\Impersonation\StopImpersonatingUserAction;

Route::get('/', [PageController::class, 'home'])->name('dashboard');

# Impersonation
Route::get('impersonate/stop', StopImpersonatingUserAction::class);
Route::get('impersonate/{userId}', ImpersonateUserAction::class);
Route::get('impersonate', [PageController::class, 'impersonate'])->name('impersonate');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('shame-log', [PageController::class, 'shameLog'])->name('shame-log');
    Route::apiResource('missed-meeting', MissedMeetingController::class)->only(['store', 'destroy']);
});
