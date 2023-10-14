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
    public const DEPARTMENT_EXISTS  = "exists:" . Department::TABLE_NAME . "," . Department::FIELD_ID;
    public const TICKET_EXISTS      = "exists:" . Ticket::TABLE_NAME . "," . Ticket::FIELD_ID;
    public const USER_EXISTS        = "exists:" . User::TABLE_NAME . "," . User::FIELD_ID;

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
