<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class IntlPhoneNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        preg_match('/^\+?[1-9]\d{1,14}$/', $value, $matches);

        if (count($matches) < 1) {
            $fail('The :attribute is not a valid phone number.');
        }
    }
}
