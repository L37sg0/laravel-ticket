<?php

namespace App\Http\Requests\Helpdesk\Department;

use App\Http\Requests\Helpdesk\RequestValidator;

class Create extends RequestValidator
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
