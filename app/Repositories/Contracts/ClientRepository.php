<?php

namespace App\Repositories\Contracts;

interface ClientRepository
{
    public function firstOrCreate(array $client) : int;
}