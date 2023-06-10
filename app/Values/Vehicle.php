<?php
namespace App\Values;

use App\Traits\ValueHelper;

readonly class Vehicle
{
    use ValueHelper;

    private string $make;
    private string $model;

    public function __construct(string $make, string $model)
    {
        $this->validateMake($make);
        $this->validateModel($model);
    }

    /**
     * Get vehicle make
     */
    public function getMake() : string 
    {
        return $this->make;
    }

    /**
     * Get vehicle model
     */
    public function getModel() : string 
    {
        return $this->model;
    }

    /**
     * Validate vehicle make
     * 
     * @throws \App\Exceptions\ValueException
     */
    protected function validateMake(string $make) : void
    {
        if(empty($make)) {
            $this->fail("Vehicle make is required");
        }
    }

    /**
     * Validate vehicle model
     * 
     * @throws \App\Exceptions\ValueException
     */
    protected function validateModel(string $model) : void
    {
        if(empty($model)) {
            $this->fail("Vehicle model is required");
        }
    }
}