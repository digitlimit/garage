<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\SlotRepository;

class SlotController extends BaseController
{
    public function __construct(
        readonly private SlotRepository $slot
    ){}

    /**
     * Fetch a listing a slots.
     */
    public function list()
    {
        return $this
            ->slot
            ->all(['id', 'name']);
    }

    /**
     * Block a slot
     */
    public function block()
    {
      
    }

    /**
     * Unblock a slot
     */
    public function unblock()
    {
      
    }
}
