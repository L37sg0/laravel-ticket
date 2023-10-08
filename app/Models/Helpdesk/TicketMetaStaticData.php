<?php

namespace App\Models\Helpdesk;

interface TicketMetaStaticData
{
    public const TABLE_NAME         = 'helpdesk_ticket_meta';

    public const FIELD_ID           = 'id';
    public const FIELD_TICKET_ID    = 'ticket_id';
    public const FIELD_KEY          = 'key';
    public const FIELD_CONTENT      = 'content';
    public const FIELD_CREATED_AT   = 'created_at';
    public const FIELD_UPDATED_AT   = 'updated_at';

    public const FILLABLE = [
        self::FIELD_TICKET_ID,
        self::FIELD_KEY,
        self::FIELD_CONTENT,
    ];

    public const CASTS = [
    ];

}
