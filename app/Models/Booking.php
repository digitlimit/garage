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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'vehicle_id',
        'slot_id',
        'date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime:Y-m-d'
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
     * Get booking slot
     * 
     * @return BelongsTo
     */
    public function slot() : BelongsTo {
        return $this->belongsTo(Slot::class);
    }

    /**
     * Scope a query to filter bookings by date
     */
    public function scopeForDate(Builder $query, CarbonInterface $date) : void
    {
        $query->where('bookings.date', $date);
    }

    /**
     * Scope all relationships
     */
    public function scopeWithRelated(Builder $query) : void 
    {
        $query
        ->join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
        ->join('clients',  'bookings.client_id',  '=', 'clients.id')
        ->join('slots',    'bookings.slot_id',    '=', 'slots.id');
    }

    /**
     * Scope select for related table columns to avoid multiple queries
     */
    public function scopeSelectedRelated(Builder $query) : void 
    {
        $query->select(
            'bookings.id',
            'bookings.date',
            'vehicles.make',
            'vehicles.model',
            'clients.name',
            'clients.email',
            'clients.phone',
            'slots.name AS slot'
        );
    }

    /**
     * Scope a query to fetch bookings with related vehicle, client and slot.
     */
    public function scopeList(Builder $query) : void 
    {
        $query
        ->withRelated()
        ->selectedRelated();
    }
}
