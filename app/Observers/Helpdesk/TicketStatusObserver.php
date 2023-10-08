<?php

namespace App\Observers\Helpdesk;
use App\Models\Helpdesk\Ticket;
use App\Models\Helpdesk\TicketStatus;

class TicketStatusObserver
{
    public function created(Ticket $ticket)
    {
        /** @var Ticket $childTicket */
        if ($ticket->isChild()) {
            foreach ($ticket->parent->childs as $childTicket) {
                $childTicket->setAttribute(Ticket::FIELD_STATUS, TicketStatus::Answered)
                    ->save();
            }
            $ticket->setAttribute(Ticket::FIELD_STATUS, TicketStatus::Pending)
                ->save();
        }
    }
}
