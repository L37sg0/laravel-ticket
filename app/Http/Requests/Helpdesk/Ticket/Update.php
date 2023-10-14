<?php

namespace App\Http\Requests\Helpdesk\Ticket;

use App\Http\Requests\Helpdesk\RequestValidator;
use App\Models\Helpdesk\Initiator;
use App\Models\Helpdesk\Ticket;
use App\Models\Helpdesk\TicketStatus;
use Illuminate\Validation\Rules\Enum;

class Update extends RequestValidator
{
    public function rules()
    {
        return [
            'ticket_id'                 => ['required', 'numeric', self::TICKET_EXISTS],
            Ticket::FIELD_DEPARTMENT_ID => ['nullable', 'numeric', self::DEPARTMENT_EXISTS],
            Ticket::FIELD_PARENT_ID     => ['nullable', 'numeric', self::TICKET_EXISTS],
            Ticket::FIELD_CUSTOMER_ID   => ['nullable', 'numeric', self::USER_EXISTS],
            Ticket::FIELD_AGENT_ID      => ['nullable', 'numeric', self::USER_EXISTS],
            Ticket::FIELD_INITIATOR     => ['nullable', 'numeric', new Enum(Initiator::class)],
            Ticket::FIELD_EXT_ID        => ['nullable', 'string', 'max:40'],
            Ticket::FIELD_SUBJECT       => ['nullable', 'string', 'max:100'],
            Ticket::FIELD_CONTENT       => ['nullable', 'string', 'max:2000'],
            Ticket::FIELD_STATUS        => ['nullable', 'numeric', new Enum(TicketStatus::class)],
        ];
    }
}
