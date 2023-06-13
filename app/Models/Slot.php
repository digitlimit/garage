<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class Slot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'start_time',
        'end_time'
    ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'start_time' => 'datetime:H:i',
    //     'end_time'   => 'datetime:H:i',
    // ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = [
    //     'start_time',
    //     'end_time'
    // ];

    /**
     * Interact with session start time value.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function startTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('H:i'),
        );
    }

    /**
     * Interact with session end time value.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function endTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('H:i'),
        );
    }

    /**
     * Scope a query to check if a slot is availble
     */
    public function scopeAvailability(Builder $query, int $slotId, CarbonInterface $date) : void
    {
        $query
        ->leftJoin('bookings',     'slots.id', '=', 'bookings.slot_id')
        ->leftJoin('closed_slots', 'slots.id', '=', 'closed_slots.slot_id')
        ->where('slots.id', $slotId)
        ->where(function(Builder $query) use($slotId, $date)
        {
            $query
            ->whereDate('bookings.date', $date)
            ->where('bookings.slot_id',  $slotId);
        })
        ->orWhere(function(Builder $query) use($slotId, $date)
        {
            $query
            ->where('closed_slots.date',    $date)
            ->where('closed_slots.slot_id', $slotId);
        });
        //@todo check the dates table
    }
}
