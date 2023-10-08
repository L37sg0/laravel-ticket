<?php

namespace App\Providers\Helpdesk;

use App\Models\Helpdesk\Department;
use App\Models\Helpdesk\Ticket;
use App\Models\Helpdesk\UserDepartment;
use App\Models\User;
use App\Observers\Helpdesk\TicketStatusObserver;
use Illuminate\Support\ServiceProvider;

class HelpdeskServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        User::resolveRelationUsing('tickets', function ($userModel) {
            return $userModel->hasMany(Ticket::class, Ticket::FIELD_AGENT_ID, User::FIELD_ID);
        });
        User::resolveRelationUsing('issues', function ($userModel) {
            return $userModel->hasMany(Ticket::class, Ticket::FIELD_CUSTOMER_ID, User::FIELD_ID);
        });
        User::resolveRelationUsing('departments', function ($userModel) {
            return $userModel->belongsToMany(Department::class, UserDepartment::TABLE_NAME);
        });
    }

    public function boot()
    {
//        parent::register();
        Ticket::observe(TicketStatusObserver::class);
    }
}
