<?php

namespace App\Http\Requests\Helpdesk\Ticket;

use App\Http\Requests\Helpdesk\ApiRequestValidator;
use App\Http\Requests\Helpdesk\ReadRequest;

class Read extends ApiRequestValidator implements ReadRequest
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
