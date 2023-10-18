<?php

namespace App\Http\Requests\Helpdesk\Department;

use App\Http\Requests\Helpdesk\ApiRequestValidator;
use App\Http\Requests\Helpdesk\IndexRequest;

class Index extends ApiRequestValidator implements IndexRequest
{
    public function rules()
    {
        return [];
    }
}
