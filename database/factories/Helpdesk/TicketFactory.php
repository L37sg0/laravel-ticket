<?php

namespace Database\Factories\Helpdesk;

use App\Models\Helpdesk\TicketStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Helpdesk\Ticket as Model;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Model::class;

    /**
     * @return array|mixed[]
     */
    public function definition()
    {
        return [
//            Model::FIELD_DEPARTMENT_ID  => '',  // Will be filled on seed.
//            Model::FIELD_PARENT_ID      => '',  // Will be filled on seed.
//            Model::FIELD_INITIATOR      => '',   // Will be filled on seed.
//            Model::FIELD_AGENT_ID       => '',  // Will be filled on seed.
//            Model::FIELD_CUSTOMER_ID    => '',  // Will be filled on seed.
            Model::FIELD_EXT_ID         => Str::uuid()->toString(),
            Model::FIELD_SUBJECT        => fake()->sentence(3),
            Model::FIELD_CONTENT        => fake()->text,
            Model::FIELD_STATUS         => TicketStatus::Open,
        ];
    }
}
