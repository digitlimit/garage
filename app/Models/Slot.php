<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as Query;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\CarbonInterface;
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
     * Scope a query to check if slot has booking
     */
    public function scopeHasBooking(
        Builder         $query, 
        int             $slotId, 
        CarbonInterface $date
    ) : void {
        $query
        ->leftJoin('bookings', 'slots.id', '=', 'bookings.slot_id')
        ->whereDate('bookings.date', $date)
        ->where('bookings.slot_id',  $slotId);
    }

    /**
     * Scope a query to check if slot is closed
     */
    public function scopeIsClosed(
        Builder         $query, 
        int             $slotId, 
        CarbonInterface $date
    ) : void {
        $query
        ->leftJoin('closed_slots', 'slots.id', '=', 'closed_slots.slot_id')
        ->whereDate('closed_slots.date', $date)
        ->where('closed_slots.slot_id', $slotId);
    }

    /**
     * Scope a query to check if date is closed
     */
    public function scopeDateIsClosed(
        Builder         $query, 
        CarbonInterface $date
    ) : void {
        $query
        ->where(function (Query $query) use($date)
        {
            $query
            ->select('date')
            ->from('closed_dates')
            ->whereDate('date', $date)
            ->limit(1);
        }, $date->toDateString());
    }

    /**
     * Scope a query to check if a slot is availble
     */
    public function scopeAvailability(
        Builder         $query, 
        int             $slotId, 
        CarbonInterface $date
    ) : void {
        $query
        ->leftJoin('bookings', 'slots.id', '=', 'bookings.slot_id')
        ->leftJoin('closed_slots', 'slots.id', '=', 'closed_slots.slot_id')
        ->where('slots.id', $slotId)
        ->where(function(Builder $query) use ($slotId, $date)
        {
            $query
            ->where(  fn(Builder $query) => $query->hasBooking($slotId, $date))
            ->orWhere(fn(Builder $query) => $query->isClosed($slotId, $date))
            ->orWhere(fn(Builder $query) => $query->dateIsClosed($date));
        });
    }

    /**
     * Fetch all the slots that closed as from today
     */
    public function scopeAsFromDate(
        Builder         $query,
        CarbonInterface $date
    ) : void {

        $query
        ->leftJoin('bookings', 'slots.id', '=', 'bookings.slot_id')
        ->leftJoin('closed_slots', 'slots.id', '=', 'closed_slots.slot_id')
        ->whereDate('bookings.date',       '>=', $date)
        ->orWhereDate('closed_slots.date', '>=', $date);
    }
}
