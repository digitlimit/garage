<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClosedSlot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slot_id',
        'date'
    ];

    /**
     * Get booking slot
     * 
     * @return BelongsTo
     */
    public function slot() : BelongsTo {
        return $this->belongsTo(Slot::class);
    }
}
