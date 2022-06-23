<?php

use App\Mail\MissedMeetingMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('impersonate/{user}', function (User $user) {
    Auth::login($user);

    return redirect('/');
});

Route::get('mail', function () {
    return new App\Mail\MissedMeetingMail();
});

Route::get('send', function () {
    Mail::to([
        [
            'name' => config('mail.recipient.name'),
            'email' => config('mail.recipient.email'),
        ],
    ])->send(new MissedMeetingMail());
});
