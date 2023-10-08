<?php

namespace App\Providers\Helpdesk;

use App\Models\Helpdesk\Ticket;
use App\Observers\Helpdesk\TicketStatusObserver;
use Illuminate\Support\ServiceProvider;

class HelpdeskServiceProvider extends ServiceProvider
{
    public function boot()
    {
//        parent::register();
        Ticket::observe(TicketStatusObserver::class);
    }
}
