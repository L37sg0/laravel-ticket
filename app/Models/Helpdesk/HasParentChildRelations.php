<?php

namespace App\Models\Helpdesk;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasParentChildRelations
{
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
