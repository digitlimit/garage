<?php

namespace App\Repositories\Eloquent;

use App\Values\Client;
use App\Models\Client as Model;
use App\Repositories\Contracts\ClientRepository as RepositoryInterface;

class ClientRepository implements RepositoryInterface
{
    public function __construct(
        /**
         * An instance of the client eloquent model
         */
        private Model $model
    ){}

    /**
     * Find the given client or create, if not exists
     * 
     * @param Client $client The client value object
     */
    public function firstOrCreate(Client $client) : int 
    {
        $client = $this
        ->model
        ->firstOrCreate(
            ['email' => $client->getEmail()],
            ['name'  => $client->getName(), 'phone' => $client->getPhone()]
        );

        return $client->id;
    }
}
