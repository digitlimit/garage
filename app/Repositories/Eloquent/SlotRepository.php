<?php

namespace App\Repositories\Eloquent;

use App\Models\Slot as Model;
use App\Repositories\Contracts\SlotRepository as RepositoryInterface;
use Carbon\CarbonInterface;

class SlotRepository implements RepositoryInterface
{
    public function __construct(
        /**
         * An instance of the vehicle eloquent model
         */
        private Model $model
    ){}

    /**
     * Fetch a list of slots
     */
    public function all(array $columns) : mixed
    {
        return $this
        ->model
        ->all($columns);
    }

    public function isAvailable(int $slotId, CarbonInterface $date) : bool
    {
        $total = $this
        ->model
        ->availability($slotId, $date)
        ->count();

        return !(bool) $total;
    }
}
