<?php

namespace App\Http\Requests\Helpdesk;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequestValidator extends FormRequest implements ValidateExistsRules
{
    /**
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->getMethod() == "POST") {
            $this->merge($this->getPayload()->all());
        }
    }

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
