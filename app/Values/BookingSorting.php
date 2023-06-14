<?php
namespace App\Values;

use App\Traits\ValueHelper;

readonly class BookingSorting
{
    use ValueHelper;
  
    /**
     * Minimum record per page
     */
    const MIN_PER_PAGE = 1;

    /**
     * Maximum record per page
     */
    const MAX_PER_PAGE = 500;

    /**
     * Booking can be ordered by the columns in the booking table
     */
    const COLUMNS = [
        'id',
        'date'
    ];

    /**
     * Bookings can be ordered by the directions
     */
    const DIRECTIONS = [
        'ASC',
        'DESC'
    ];

    /**
     * Booking ordering table column
     */
    private string $column;

    /**
     * Booking ordering direction
     */
    private string $direction;
   
    public function __construct(string $column, string $direction)
    {
        $this->validateColumn($column);
        $this->validateDirection($direction);

        $this->column    = $column;
        $this->direction = $direction;
    }

    /**
     * Get the booking ordering column
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Get the booking ordering direciton
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Validate booking ordering direction
     * 
     * @throws \App\Exceptions\ValueException
     */
    protected function validateDirection(string $direction) : void
    {
        if(!in_array($direction, self::DIRECTIONS)) {
            $this->fail(
                'Invalid booking ordering direction. Available: '
                . implode(',', self::DIRECTIONS)
            );
        }
    }

     /**
     * Validate booking ordering column
     * 
     * @throws \App\Exceptions\ValueException
     */
    protected function validateColumn(string $column) : void
    {
        if(!in_array($column, self::COLUMNS)) {
            $this->fail(
                'Invalid booking ordering column. Available: ' 
                . implode(',', self::COLUMNS)
            );
        }
    }
}