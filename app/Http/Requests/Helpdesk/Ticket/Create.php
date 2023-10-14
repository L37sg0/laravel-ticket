<?php

namespace App\Http\Requests\Helpdesk\Ticket;

use App\Http\Requests\Helpdesk\RequestValidator;
use App\Models\Helpdesk\Initiator;
use App\Models\Helpdesk\Ticket;
use App\Models\Helpdesk\TicketStatus;
use Illuminate\Validation\Rules\Enum;

class Create extends RequestValidator
{
    public function rules()
    {
        return [
            'content_type'              => ['required', self::CONTENT_IS_JSON],
            Ticket::FIELD_DEPARTMENT_ID => ['required', 'numeric', self::DEPARTMENT_EXISTS],
            Ticket::FIELD_PARENT_ID     => ['nullable', 'numeric', self::TICKET_EXISTS],
            Ticket::FIELD_CUSTOMER_ID   => ['nullable', 'numeric', self::USER_EXISTS],
            Ticket::FIELD_AGENT_ID      => ['nullable', 'numeric', self::USER_EXISTS],
            Ticket::FIELD_INITIATOR     => ['required', 'numeric', new Enum(Initiator::class)],
            Ticket::FIELD_EXT_ID        => ['required', 'string' , 'max:40', self::TICKET_EXT_ID_UNIQUE],
            Ticket::FIELD_SUBJECT       => ['required', 'string' , 'max:100'],
            Ticket::FIELD_CONTENT       => ['required', 'string' , 'max:2000'],
            Ticket::FIELD_STATUS        => ['required', 'numeric', new Enum(TicketStatus::class)],
        ];
    }
}
