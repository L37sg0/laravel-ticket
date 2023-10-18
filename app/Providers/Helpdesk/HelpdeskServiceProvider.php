<?php

namespace App\Providers\Helpdesk;

use App\Http\Kernel;
use App\Models\Helpdesk\Department;
use App\Models\Helpdesk\Ticket;
use App\Models\Helpdesk\UserDepartment;
use App\Models\User;
use App\Observers\Helpdesk\TicketStatusObserver;
//use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class HelpdeskServiceProvider extends ServiceProvider implements ControllerServiceConfig
{

    public function boot()
    {
        $this->bootRoutes();
        $this->bootExceptionHandlers();
        $this->bootCommands();
        $this->bootObservation();
    }

    public function register()
    {
        $this->registerControllerServices();
        $this->registerExceptionHandlers();
        $this->registerDynamicRelations();
    }

    public function bootRoutes()
    {
//        Route::group(['as' => 'api.', 'prefix' => 'api'], function () {
//            $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
//        });
        // TODO put module routes here or point a file with routes
    }

    public function bootExceptionHandlers()
    {
        /** @var Kernel $kernel */
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(\App\Exceptions\Helpdesk\ApiExceptionHandler::class);
    }

    public function bootCommands()
    {
        // TODO put module commands, if any, here
    }

    public function bootObservation()
    {
        Ticket::observe(TicketStatusObserver::class);
    }

    public function registerControllerServices()
    {
        foreach (self::CONTROLLER_SERVICES as $controller => $services) {
            foreach ($services as $something => $somethingElse) {
                $this->app->when($controller)->needs($something)->give(function ($app) use ($something, $somethingElse) {
                    if ($something == '$config') {
                        foreach ($somethingElse as $key => $value) {
                            $app->bind($key, $value);
                        }
                    }
                    return $somethingElse;
                });
            }
        }
    }

    public function registerExceptionHandlers()
    {
        $this->app->bind(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \App\Exceptions\Helpdesk\ApiExceptionHandler::class
        );
    }

    public function registerDynamicRelations()
    {
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
}
