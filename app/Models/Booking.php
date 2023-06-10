<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Carbon\CarbonInterface;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'slot_start' => 'datetime:Y-m-d H:i:s',
        'slot_end'   => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'slot_start',
        'slot_end'
    ];

    /**
     * Get booking client
     * 
     * @return BelongsTo
     */
    public function client() : BelongsTo {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get booking vehicle
     * 
     * @return BelongsTo
     */
    public function vehicle() : BelongsTo {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Interact with slot start time value.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function slotStart(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('H:i'),
        );
    }

    /**
     * Interact with slot end time value.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function slotEnd(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('H:i'),
        );
    }

    /**
     * Scope a query to filter bookings by date
     */
    public function scopeForDate(Builder $query, CarbonInterface $date) : void
    {
        $query
        ->where('bookings.slot_start', $date);
    }

    /**
     * Scope a query to fetch bookings with related vehicle and client.
     */
    public function scopeList(Builder $query) : void 
    {
        $query
        ->with('vehicle:id,make,model')
        ->with('client:id,name,phone,email');
    }
}
