<?php

namespace App\Http\Requests\Helpdesk\Department;

use App\Http\Requests\Helpdesk\ApiRequestValidator;
use App\Http\Requests\Helpdesk\ExportRequest;

class Export extends ApiRequestValidator implements ExportRequest
{

    public function rules()
    {
        return [
            // TODO: Implement rules() method.
        ];
    }
}
