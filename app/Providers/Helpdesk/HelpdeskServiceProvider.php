<?php

namespace App\Providers\Helpdesk;

use App\Http\Kernel;
use App\Models\Helpdesk\Department;
use App\Models\Helpdesk\Ticket;
use App\Models\Helpdesk\UserDepartment;
use App\Models\User;
use App\Observers\Helpdesk\TicketStatusObserver;
use Illuminate\Support\ServiceProvider;

class HelpdeskServiceProvider extends ServiceProvider
{

    public function boot()
    {
        /** @var Kernel $kernel */
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(\App\Exceptions\Helpdesk\ApiExceptionHandler::class);

        Ticket::observe(TicketStatusObserver::class);
    }

    public function register()
    {
        parent::register();

        /** Dynamic Relations */
        User::resolveRelationUsing('tickets', function ($userModel) {
            return $userModel->hasMany(Ticket::class, Ticket::FIELD_AGENT_ID, User::FIELD_ID);
        });
        User::resolveRelationUsing('issues', function ($userModel) {
            return $userModel->hasMany(Ticket::class, Ticket::FIELD_CUSTOMER_ID, User::FIELD_ID);
        });
        User::resolveRelationUsing('departments', function ($userModel) {
            return $userModel->belongsToMany(Department::class, UserDepartment::TABLE_NAME);
        });

        /** Exception Handlers */
        $this->app->bind(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \App\Exceptions\Helpdesk\ApiExceptionHandler::class
        );
    }
}
