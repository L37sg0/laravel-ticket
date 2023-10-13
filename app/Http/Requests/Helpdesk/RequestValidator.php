<?php

namespace App\Http\Requests\Helpdesk;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestValidator extends FormRequest
{
    /**
     * @param Validator $validator
     * @return mixed
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 400));
    }
}
