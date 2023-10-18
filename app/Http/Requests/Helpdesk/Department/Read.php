<?php

namespace App\Http\Requests\Helpdesk\Department;

use App\Http\Requests\Helpdesk\ApiRequestValidator;
use App\Http\Requests\Helpdesk\ReadRequest;

class Read extends ApiRequestValidator implements ReadRequest
{
    public function rules()
    {
        return [
            "department_id" => ['required', 'numeric', self::DEPARTMENT_EXISTS]
        ];
    }
}
