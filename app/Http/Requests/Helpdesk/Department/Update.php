<?php

namespace App\Http\Requests\Helpdesk\Department;

use App\Http\Requests\Helpdesk\ApiRequestValidator;
use App\Http\Requests\Helpdesk\UpdateRequest;

class Update extends ApiRequestValidator implements UpdateRequest
{
    public function rules()
    {
        return [];
    }
}
