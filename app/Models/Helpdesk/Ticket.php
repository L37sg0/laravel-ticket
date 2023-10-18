<?php

namespace App\Models\Helpdesk;

use App\Models\Helpdesk\TicketStaticData as StaticData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model implements StaticData
{
    use HasFactory;
    use HasParentChildRelations;

    protected $table    = self::TABLE_NAME;
    protected $fillable = self::FILLABLE;
    protected $casts    = self::CASTS;

    /**
     * @return HasOne
     */
    public function department()
    {
        return $this->hasOne(Department::class, Department::FIELD_ID);
    }

    /**
     * @return HasOne
     */
    public function agent()
    {
        return $this->hasOne(User::class, User::FIELD_ID, self::FIELD_AGENT_ID);
    }

    /**
     * @return HasOne
     */
    public function customer()
    {
        return $this->hasOne(User::class, User::FIELD_ID, self::FIELD_CUSTOMER_ID);
    }

    /**
//     * @return Collection
     */
    public function attachments()
    {
        $attachments = $this->hasMany(TicketMeta::class)->where([TicketMeta::FIELD_KEY => 'attachment'])->get();
        if ($this->isParent()) {
            foreach ($this->childs as $child) {
                foreach ($child->attachments() as $attachment) {
                    $attachments->push($attachment);
                }
            }
        }
        return $attachments;
//        return $this->hasMany(TicketMeta::class)->with('attachment');
    }

}
