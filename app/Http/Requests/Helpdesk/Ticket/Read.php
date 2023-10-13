<?php

namespace App\Http\Requests\Helpdesk\Ticket;

use App\Http\Requests\Helpdesk\RequestValidator;

class Read extends RequestValidator
{
    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'ticket_id' => 'required',
        ];
    }

//    /**
//     * @return string[]
//     */
//    public function messages()
//    {
//        return [
//            'ticket_id.required'    => 'Parameter ticket_id is required',
//        ];
//    }
}
