<?php
namespace App\Values;

use Carbon\CarbonInterface;
use App\Traits\ValueHelper;

readonly class BookingDate
{
    use ValueHelper;

    private CarbonInterface $start;
    private CarbonInterface $end;

    public function __construct(CarbonInterface $start, CarbonInterface $end)
    {
        $this->validateInterval($start, $end);
        $this->start = $start;
        $this->end   = $end;
    }

    /**
     * Got booking date start
     */
    public function getStart() : CarbonInterface
    {
        return $this->start;
    }

    /**
     * Get booking date end
     */
    public function getEnd() : CarbonInterface
    {
        return $this->end;
    }

    /**
     * Validate booking date interval
     * 
     * @throws \App\Exceptions\ValueException
     */
    protected function validateInterval($start, $end) : void
    {
        if($end > $start) {
            $this->fail('End time cannot be greater that Start time');
        }
    }
}