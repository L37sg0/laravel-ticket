<?php

namespace App\Http\Requests\Helpdesk\Ticket;

use App\Http\Requests\Helpdesk\ApiRequestValidator;
use App\Http\Requests\Helpdesk\ImportRequest;

class Import extends ApiRequestValidator implements ImportRequest
{

    public function rules()
    {
        return [
            // TODO: Implement rules() method.
        ];
    }
}
