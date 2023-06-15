<?php

namespace App\Http\Controllers\API;

use App\Values\Client;
use App\Values\Vehicle;
use App\Helpers\LogHelper;
use Illuminate\Support\Carbon;
use App\Helpers\ResponseHelper;
use App\Services\BookingService;
use App\Exceptions\ValueException;
use App\Http\Requests\Booking\CreateRequest;
use App\Http\Requests\Booking\ListRequest;

class BookingController extends BaseController
{
    public function __construct(
        readonly private LogHelper $log,
        readonly private BookingService $booking,
        readonly private ResponseHelper $response,
        readonly private Carbon $carbon
    ){}

    /**
     * View a booking.
     */
    public function view(int $bookingId)
    {
        $booking = $this
        ->booking
        ->find($bookingId);

        return $this->response->ok($booking);
    }

    /**
     * Fetch a listing a bookings.
     */
    public function list(ListRequest $request)
    {
        try{
            $perPage       = $request->validated('per_page', 15);
            $sortColumn    = $request->validated('sort_column', 'date');
            $sortDirection = $request->validated('sort_direction', 'DESC');
    
            $list = $this
                ->booking
                ->list($sortColumn, $sortDirection, $perPage);
    
            return $this
            ->response
            ->ok($list);

        } catch(ValueException $e) {
            return $this->response->error($e->getMessage());
        } catch(\Exception $e)  {
            $this->log->info($e->getMessage());
            return $this->response->server();
        }
    }

    /**
     * Store a newly created booking in storage.
     */
    public function create(CreateRequest $request)
    {
        try {
            // only validated form inputs
            $slotId = $request->validated('slot');
            $name   = $request->validated('name');
            $email  = $request->validated('email');
            $phone  = $request->validated('phone');
            $model  = $request->validated('model');
            $make   = $request->validated('make');
            $dateString = $request->validated('date');

            $date = $this
            ->carbon
            ->createFromFormat('Y-m-d', $dateString);
            
            // value objects
            $client  = new Client($name, $phone, $email);
            $vehicle = new Vehicle($make, $model);
           
            $this->booking
                ->addNew($slotId, $client, $vehicle, $date);

            return $this->response->noContent();

        } catch(ValueException $e) {
            return $this->response->error($e->getMessage());
        } catch(\Exception $e)  {
            $this->log->info($e->getMessage());
            return $this->response->server();
        }
    }
}
