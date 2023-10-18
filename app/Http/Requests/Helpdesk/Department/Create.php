<?php

namespace App\Http\Requests\Helpdesk\Department;

use App\Http\Requests\Helpdesk\ApiRequestValidator;
use App\Http\Requests\Helpdesk\CreateRequest;

class Create extends ApiRequestValidator implements CreateRequest
{
    public function rules()
    {
        return [
            'parent_id'     => [],
            'title'         => 'required',
            'meta_title'    =>  '',
            'slug'          => ''
        ];
    }
}
