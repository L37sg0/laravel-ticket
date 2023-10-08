<?php

namespace Database\Factories\Helpdesk;

use App\Models\Helpdesk\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Helpdesk\TicketMeta as Model;

class TicketMetaFactory extends Factory
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
        $ticketIds = Ticket::all()->pluck(Ticket::FIELD_ID)->toArray();
        $ticketId = $ticketIds[array_rand($ticketIds)];
        $fileSuffixes = ['.jpg','.jpeg','.png','.txt','.pdf','.xlsx'];
        $fileSuffix = $fileSuffixes[array_rand($fileSuffixes)];

        return [
            Model::FIELD_TICKET_ID  => $ticketId,
            Model::FIELD_KEY        => 'attachment',
            Model::FIELD_CONTENT    => "/storage/attachments/$ticketId/" . fake()->word . $fileSuffix,
        ];
    }
}
