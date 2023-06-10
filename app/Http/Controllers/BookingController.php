<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\CreateRequest;
use App\Http\Requests\Booking\ListRequest;

class BookingController extends Controller
{
    /**
     * Fetch a listing a bookings.
     */
    public function list(ListRequest $request)
    {
      
    }

    /**
     * Store a newly created booking in storage.
     */
    public function create(CreateRequest $request)
    {
        // try {
        //     // only validated form inputs
        //     $name  = $request->validated('name');
        //     $email = $request->validated('email');
        //     $phone = $request->validated('phone');
        //     $model = $request->validated('model');
        //     $make  = $request->validated('make');
        //     $start = $request->date('slot_start');
        //     $end   = $request->date('slot_end');

        // } catch(\Exception $e) {
        //     // return json 
        // }
    }
}
