<?php

namespace App\Models\Helpdesk;

use App\Models\Helpdesk\DepartmentStaticData as StaticData;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model implements StaticData
{
    use HasFactory;
    use HasParentChildRelations;

    protected $table    = self::TABLE_NAME;
    protected $fillable = self::FILLABLE;
    protected $casts    = self::CASTS;

    /**
     * @return BelongsToMany
     */
    public function agents()
    {
        return $this->belongsToMany(User::class, UserDepartment::TABLE_NAME);
    }

    /**
     * @return HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }


}
