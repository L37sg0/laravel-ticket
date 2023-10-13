<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateRequestMethodGet implements ValidationRule
{

    /**
     * @inheritDoc
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value !== 'get') {
            $fail('This resource supports only HTTP method GET.');
        }
    }
//
//    public function passes($attribute, $value)
//    {
//        return request()->isMethod('get');
//    }
//
//    /**
//     * @inheritDoc
//     */
//    public function message()
//    {
//        return 'Your HTTP request method should be GET.';
//    }
}
