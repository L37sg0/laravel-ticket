<?php

namespace App\Models\Helpdesk;

interface TicketStaticData
{
    public const TABLE_NAME = 'helpdesk_ticket';

    public const FIELD_ID               = 'id';
    public const FIELD_DEPARTMENT_ID    = 'department_id';
    public const FIELD_PARENT_ID        = 'parent_id';      // Primary Ticket is a parent, each answer of it is child.
    public const FIELD_INITIATOR        = 'initiator';      // Who created the ticket - customer or agent
    public const FIELD_CUSTOMER_ID      = 'customer_id';    // ID of the user who created the ticket
    public const FIELD_AGENT_ID         = 'agent_id';       // ID of the user who need to answer the ticket.
    public const FIELD_EXT_ID           = 'ext_id';         // Unique external identifier of the ticket.
    public const FIELD_SUBJECT          = 'subject';
    public const FIELD_CONTENT          = 'content';
    public const FIELD_STATUS           = 'status';
    public const FIELD_CREATED_AT       = 'created_at';
    public const FIELD_UPDATED_AT       = 'updated_at';

    public const FILLABLE = [
        self::FIELD_DEPARTMENT_ID,
        self::FIELD_PARENT_ID,
        self::FIELD_INITIATOR,
        self::FIELD_CUSTOMER_ID,
        self::FIELD_AGENT_ID,
        self::FIELD_EXT_ID,
        self::FIELD_SUBJECT,
        self::FIELD_CONTENT,
        self::FIELD_STATUS,
    ];

    public const CASTS = [
        self::FIELD_STATUS      => TicketStatus::class,
        self::FIELD_INITIATOR   => Initiator::class
    ];
}
