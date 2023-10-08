<?php

namespace App\Models\Helpdesk;

enum TicketStatus: int
{
    case Open       = 1;    // Ticket conversation is open and in progress.
    case Pending    = 2;    // Ticket is waiting for answer.
    case Answered   = 3;    // Ticket is answered.
    case Closed     = 4;    // Ticket conversation is closed and done.
}
