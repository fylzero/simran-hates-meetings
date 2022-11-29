<?php

namespace App\Actions\Impersonation;

class StopImpersonatingUserAction
{
    public function __invoke()
    {
        // Log in as original user
        $user = auth()->loginUsingId(session('impersonated_by'));

        // Clear session key
        session()->forget('impersonated_by');

        return redirect('/');
    }
}
