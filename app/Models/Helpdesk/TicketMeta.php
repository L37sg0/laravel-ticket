<?php

namespace App\Models\Helpdesk;

use App\Models\Helpdesk\TicketMetaStaticData as StaticData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMeta extends Model implements StaticData
{
    use HasFactory;

    protected $table    = self::TABLE_NAME;
    protected $fillable = self::FILLABLE;
    protected $casts    = self::CASTS;
}
