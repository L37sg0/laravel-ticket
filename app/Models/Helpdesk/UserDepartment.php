<?php

namespace App\Models\Helpdesk;

use App\Models\Helpdesk\UserDepartmentStaticData as StaticData;
use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model implements StaticData
{
    protected $table    = self::TABLE_NAME;
    protected $fillable = self::FILLABLE;
    protected $casts    = self::CASTS;
}
