<?php

namespace App\Http\Requests\Helpdesk;

use App\Models\Helpdesk\Department;
use App\Models\Helpdesk\Ticket;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestValidator extends FormRequest
{
    public const DEPARTMENT_EXISTS      = 'exists:' . Department::TABLE_NAME . ',' . Department::FIELD_ID;
    public const TICKET_EXISTS          = 'exists:' . Ticket::TABLE_NAME     . ',' . Ticket::FIELD_ID;
    public const TICKET_EXT_ID_UNIQUE   = 'unique:' . Ticket::TABLE_NAME     . ',' . Ticket::FIELD_EXT_ID;
    public const USER_EXISTS            = 'exists:' . User::TABLE_NAME       . ',' . User::FIELD_ID;
    public const CONTENT_IS_JSON        = 'in:application/json';
// TODO Make sure API accepts only json requests for POST methods with payload instead of Url parameters.
    protected function prepareForValidation()
    {
        $this->merge([
            'content_type' => $this->headers->get('Content-type')
        ]);
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
