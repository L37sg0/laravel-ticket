<?php

namespace App\Http\Requests\Helpdesk\Department;

use App\Http\Requests\Helpdesk\ApiRequestValidator;
use App\Http\Requests\Helpdesk\DeleteRequest;

class Delete extends ApiRequestValidator implements DeleteRequest
{
    public function rules()
    {
        return [];
    }
}
