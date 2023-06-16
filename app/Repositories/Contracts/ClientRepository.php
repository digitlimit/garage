<?php

namespace App\Repositories\Contracts;

use App\Values\Client;

interface ClientRepository
{
    /**
     * Find the given client or create, if not exists
     *
     * @param  Client  $client The client value object
     */
    public function firstOrCreate(Client $client): int;
}
