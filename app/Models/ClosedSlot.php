<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    /**
     * Fetch all the dates that closed as from the given date
     */
    public function scopeAsFromDate(
        Builder         $query,
        CarbonInterface $date
    ) : void {
        $query
        ->join('slots', 'closed_slots.slot_id', '=', 'slots.id')
        ->whereDate('closed_slots.date', '>=', $date);
    }

    /**
     * Fetch closed slots by slot ID and date
     */
    public function scopeClosedFor(
        Builder         $query,
        int             $slotId,
        CarbonInterface $date
    ) : void {
        $query
        ->where('closed_slots.slot_id', $slotId)
        ->whereDate('closed_slots.date', $date);
    }
}
