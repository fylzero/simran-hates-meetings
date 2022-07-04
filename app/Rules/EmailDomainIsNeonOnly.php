<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailDomainIsNeonOnly implements Rule
{
    // Create a new rule instance.
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value): bool
    {
        $domain = substr($value, strpos($value, '@') + 1);

        return in_array($domain, explode(',', config('app.allowed_domains')));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email must be a company address.';
    }
}
