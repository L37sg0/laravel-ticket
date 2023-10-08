<?php

namespace App\Models;

interface UserStaticData
{
    public const TABLE_NAME                 = 'users';

    public const FIELD_ID                   = 'id';
    public const FIELD_NAME                 = 'name';
    public const FIELD_EMAIL                = 'email';
    public const FIELD_PASSWORD             = 'password';
    public const FIELD_EMAIL_VERIFIED_AT    = 'email_verified_at';
    public const FIELD_REMEMBER_TOKEN       = 'remember_token';
    public const FIELD_CREATED_AT           = 'created_at';
    public const FIELD_UPDATED_AT           = 'updated_at';

    public const FILLABLE = [
        self::FIELD_NAME,
        self::FIELD_EMAIL,
        self::FIELD_PASSWORD
    ];

    public const CASTS = [
        self::FIELD_EMAIL_VERIFIED_AT   => 'datetime',
        self::FIELD_PASSWORD            => 'hashed'
    ];

    public const HIDDEN = [
        self::FIELD_PASSWORD,
        self::FIELD_REMEMBER_TOKEN
    ];
}
