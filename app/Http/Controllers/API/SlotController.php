<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\SlotRepository;

class SlotController extends BaseController
{
    public function __construct(
        readonly private SlotRepository $slot
    ){}

    /**
     * Fetch a list of slots.
     */
    public function list()
    {
        return $this
            ->slot
            ->all(['id', 'name']);
    }

    /**
     * Fetch a list of closed slots.
     */
    public function closed()
    {   //@todo implement
        return $this
            ->slot
            ->all(['id', 'name']);
    }

    /**
     * Close a slot to prevent client's from picking them
     */
    public function close(int $slotId)
    {
      
    }

    /**
     * Open a closed slot to allow client's to pick them
     */
    public function open(int $slotId)
    {
      
    }
}
