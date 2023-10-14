<?php

namespace App\Http\Requests\Helpdesk\Ticket;

use App\Http\Requests\Helpdesk\RequestValidator;

class Delete extends RequestValidator
{
    public function rules()
    {
        return [
            'content_type'  => ['required', self::CONTENT_IS_JSON],
            'ticket_id'     => ['required', 'numeric', self::TICKET_EXISTS],
        ];
    }
}
