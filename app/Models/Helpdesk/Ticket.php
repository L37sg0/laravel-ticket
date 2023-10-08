<?php

namespace App\Models\Helpdesk;

use App\Models\Helpdesk\TicketStaticData as StaticData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model implements StaticData
{
    use HasFactory;

    protected $table    = self::TABLE_NAME;
    protected $fillable = self::FILLABLE;
    protected $casts    = self::CASTS;

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, self::FIELD_PARENT_ID, self::FIELD_ID);
    }

    /**
     * @return HasMany
     */
    public function childs()
    {
        return $this->hasMany(self::class, self::FIELD_PARENT_ID, self::FIELD_ID);
    }

    /**
     * @return bool
     */
    public function isParent()
    {
        if ($this->childs()->count() > 0) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isChild()
    {
        return (!$this->parent == null);
    }

}
