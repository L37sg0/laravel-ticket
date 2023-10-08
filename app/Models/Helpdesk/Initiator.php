<?php

namespace App\Models\Helpdesk;

enum Initiator: int
{
    case Customer   = 1;
    case Agent      = 2;
}
