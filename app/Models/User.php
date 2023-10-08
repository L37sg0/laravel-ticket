<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserStaticData as StaticData;

class User extends Authenticatable implements StaticData
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $table    = self::TABLE_NAME;
    protected $fillable = self::FILLABLE;
    protected $hidden   = self::HIDDEN;
    protected $casts    = self::CASTS;
}
