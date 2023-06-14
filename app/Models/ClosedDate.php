<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\CarbonInterface;
use Carbon\Carbon;

class ClosedDate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
     * Fetch all the dates that closed as from the given date
     */
    public function scopeAsFromDate(
        Builder         $query,
        CarbonInterface $date
    ) : void {
        $query->whereDate('closed_dates.date', '>=', $date);
    }
}
