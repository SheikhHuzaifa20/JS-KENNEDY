<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BlockMailinator implements Rule
{
    public function passes($attribute, $value)
    {
        return !str_contains(strtolower($value), '@mailinator.com');
    }

    public function message()
    {
        return 'Email addresses from mailinator.com are not allowed.';
    }
}
