<?php

namespace App\Actions\Impersonation;

use App\Models\User;
use Illuminate\Support\Str;

class ImpersonateUserAction
{
    public function __invoke($userId)
    {
        // Deny impersonation if not local or authorized user in prod
        if (
            !app()->isLocal()
            && (
                auth()->check()
                && Str::lower(auth()->user()->email) != Str::lower(config('horizon.allowed_user_email'))
            )
        ) {
            abort(403);
        }

        // Drop original user's (or horizon allowed user) id to session key
        session([
            'impersonated_by' => auth()->check()
                ? auth()->user()->id
                : User::where('email', config('horizon.allowed_user_email'))->first()->id,
        ]);

        // Log in as impersonated user
        $user = auth()->loginUsingId($userId);

        return redirect('/');
    }
}
