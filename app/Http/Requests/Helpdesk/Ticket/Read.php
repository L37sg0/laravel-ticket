<?php

namespace App\Http\Requests\Helpdesk\Ticket;

use App\Http\Requests\Helpdesk\RequestValidator;

class Read extends RequestValidator
{
    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            'ticket_id' => ['required', 'numeric', self::TICKET_EXISTS],
        ];
    }

}
