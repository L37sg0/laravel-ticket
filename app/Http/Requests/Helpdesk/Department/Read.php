<?php

namespace App\Http\Requests\Helpdesk\Department;

use App\Http\Requests\Helpdesk\RequestValidator;

class Read extends RequestValidator
{
    public function rules()
    {
        return [
            "department_id" => "required"
        ];
    }
}
