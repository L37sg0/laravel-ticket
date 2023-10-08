<?php

namespace App\Models\Helpdesk;

use App\Models\Helpdesk\DepartmentStaticData as StaticData;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model implements StaticData
{
    use HasFactory;

    protected $table    = self::TABLE_NAME;
    protected $fillable = self::FILLABLE;
    protected $casts    = self::CASTS;

    public function users()
    {
        return $this->belongsToMany(User::class, UserDepartment::TABLE_NAME);
    }
}
