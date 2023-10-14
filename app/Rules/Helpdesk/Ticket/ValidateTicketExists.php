<?php

namespace App\Rules\Helpdesk\Ticket;

use App\Exceptions\Helpdesk\ResourceNotFoundHttpException;
use App\Models\Helpdesk\Ticket;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/** @deprecated  */
class ValidateTicketExists implements ValidationRule
{

    /**
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $ticket = Ticket::find($value);
        if (empty($ticket)) {
            throw new ResourceNotFoundHttpException();
        }
    }
}
