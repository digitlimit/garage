<?php
namespace App\Values;

use App\Traits\ValueHelper;

readonly class Client
{
    use ValueHelper;

    private string $name;
    private string $phone;
    private string $email;

    public function __construct(string $name, string $phone, string $email)
    {
        $this->validateName($name);
        $this->validatePhone($phone);
        $this->validateEmail($email);

        $this->name  = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    /**
     * Get client's name
     */
    public function getName() : string 
    {
        return $this->name;
    }

    /**
     * Get client's phone
     */
    public function getPhone() : string 
    {
        return $this->phone;
    }
    
    /**
     * Get client's email
     */
    public function getEmail() : string 
    {
        return $this->email;
    }

    /**
     * Validate client name
     * 
     * @throws \App\Exceptions\ValueException
     */
    protected function validateName(string $name) : void
    {
        if(empty($name)) {
            $this->fail("Client name is required");
        }
    }

    /**
     * Validate client phone
     * 
     * @throws \App\Exceptions\ValueException
     */
    protected function validatePhone(string $phone) : void
    {
        if(empty($phone)) {
            $this->fail("Client phone number is required");
        }
    }

    /**
     * Validate client email
     * 
     * @throws \App\Exceptions\ValueException
     */
    protected function validateEmail(string $email) : void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->fail("Invalid client email address");
        }
    }
}