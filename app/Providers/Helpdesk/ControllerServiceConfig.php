<?php

namespace App\Providers\Helpdesk;

use App\Http\Controllers\Helpdesk\DepartmentController;
use App\Http\Controllers\Helpdesk\TicketController;
use App\Http\Requests\Helpdesk\CreateRequest;
use App\Http\Requests\Helpdesk\DeleteRequest;
use App\Http\Requests\Helpdesk\ExportRequest;
use App\Http\Requests\Helpdesk\ImportRequest;
use App\Http\Requests\Helpdesk\IndexRequest;
use App\Http\Requests\Helpdesk\ReadRequest;
use App\Http\Requests\Helpdesk\UpdateRequest;
use App\Models\Helpdesk\Department;
use App\Models\Helpdesk\Ticket;

interface ControllerServiceConfig
{
    public const CONTROLLER_SERVICES = [
        DepartmentController::class    => [
            '$slug'                 => 'Department',
            '$index'                => 'department_id',
            '$modelClass'           => Department::class,
            '$config'               => [
                IndexRequest::class     => \App\Http\Requests\Helpdesk\Department\Index::class,
                CreateRequest::class    => \App\Http\Requests\Helpdesk\Department\Create::class,
                ReadRequest::class      => \App\Http\Requests\Helpdesk\Department\Read::class,
                UpdateRequest::class    => \App\Http\Requests\Helpdesk\Department\Update::class,
                DeleteRequest::class    => \App\Http\Requests\Helpdesk\Department\Delete::class,
                ImportRequest::class    => \App\Http\Requests\Helpdesk\Department\Import::class,
                ExportRequest::class    => \App\Http\Requests\Helpdesk\Department\Export::class,
            ],
        ],
        TicketController::class     => [
            '$slug'                 => 'Ticket',
            '$index'                => 'ticket_id',
            '$modelClass'           => Ticket::class,
            '$config'               => [
                IndexRequest::class     => \App\Http\Requests\Helpdesk\Ticket\Index::class,
                CreateRequest::class    => \App\Http\Requests\Helpdesk\Ticket\Create::class,
                ReadRequest::class      => \App\Http\Requests\Helpdesk\Ticket\Read::class,
                UpdateRequest::class    => \App\Http\Requests\Helpdesk\Ticket\Update::class,
                DeleteRequest::class    => \App\Http\Requests\Helpdesk\Ticket\Delete::class,
                ImportRequest::class    => \App\Http\Requests\Helpdesk\Ticket\Import::class,
                ExportRequest::class    => \App\Http\Requests\Helpdesk\Ticket\Export::class,
            ]
        ],
    ];
}
