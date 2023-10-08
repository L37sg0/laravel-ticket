<?php

namespace App\Models\Helpdesk;

interface UserDepartmentStaticData
{
    public const TABLE_NAME             = 'helpdesk_user_department';

    public const FIELD_ID               = 'id';
    public const FIELD_USER_ID          = 'user_id';
    public const FIELD_DEPARTMENT_ID    = 'department_id';
    public const FIELD_CREATED_AT       = 'created_at';
    public const FIELD_UPDATED_AT       = 'updated_at';

    public const FILLABLE = [
        self::FIELD_USER_ID,
        self::FIELD_DEPARTMENT_ID
    ];

    public const CASTS = [];
}
