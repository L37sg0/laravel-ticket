<?php

namespace App\Http\Requests\Helpdesk;


use App\Models\Helpdesk\Department;
use App\Models\Helpdesk\Ticket;
use App\Models\User;

interface ValidateExistsRules
{
    public const DEPARTMENT_EXISTS      = 'exists:' . Department::TABLE_NAME    . ',' . Department::FIELD_ID;
    public const TICKET_EXISTS          = 'exists:' . Ticket::TABLE_NAME        . ',' . Ticket::FIELD_ID;
    public const TICKET_EXT_ID_UNIQUE   = 'unique:' . Ticket::TABLE_NAME        . ',' . Ticket::FIELD_EXT_ID;
    public const USER_EXISTS            = 'exists:' . User::TABLE_NAME          . ',' . User::FIELD_ID;
}
