<?php

namespace App\Http\Requests\Helpdesk\Ticket;

use App\Http\Requests\Helpdesk\ApiRequestValidator;
use App\Http\Requests\Helpdesk\DeleteRequest;

class Delete extends ApiRequestValidator implements DeleteRequest
{
    public function rules()
    {
        return [
            'ticket_id'     => ['required', 'numeric', self::TICKET_EXISTS],
        ];
    }
}
