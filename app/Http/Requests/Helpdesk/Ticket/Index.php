<?php

namespace App\Http\Requests\Helpdesk\Ticket;

use App\Http\Requests\Helpdesk\RequestValidator;

class Index extends RequestValidator
{
    public function rules()
    {
        return [
            'per_page'  => ['nullable', 'numeric']
        ];
    }
}
