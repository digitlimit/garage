<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Booking\CreateRequest;
use App\Http\Requests\Booking\ListRequest;
use App\Services\BookingService;
use App\Values\{Client, Vehicle};

class BookingController extends BaseController
{
    public function __construct(
        readonly private BookingService $booking
    ){}

    /**
     * View a booking.
     */
    public function view(int $bookingId)
    {
        return $this
        ->booking
        ->find($bookingId);
    }

    /**
     * Fetch a listing a bookings.
     */
    public function list(ListRequest $request)
    {
        $perPage       = $request->validated('per_page', 15);
        $sortColumn    = $request->validated('sort_column', 'date');
        $sortDirection = $request->validated('sort_direction', 'DESC');

        $list = $this
            ->booking
            ->list($sortColumn, $sortDirection, $perPage);

        return $list;
    }

    /**
     * Store a newly created booking in storage.
     */
    public function create(CreateRequest $request)
    {
        try {
            // only validated form inputs
            $slotId = $request->validated('slot_id');
            $name   = $request->validated('name');
            $email  = $request->validated('email');
            $phone  = $request->validated('phone');
            $model  = $request->validated('model');
            $make   = $request->validated('make');
            $date   = $request->date('date');

            // value objects
            $client  = new Client($name, $phone, $email);
            $vehicle = new Vehicle($make, $model);
            
            $this->booking
                ->addNew($slotId, $client, $vehicle, $date);

            return response()->noContent();

        } catch(\Exception $e) {
            //@todo fix response
            return response()->json([
                'error' => 'unable to creeate'
            ]);
        }
    }
}
