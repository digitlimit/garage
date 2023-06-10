<?php

namespace App\Repositories\Eloquent;

use App\Models\Client as Model;
use App\Repositories\Contracts\ClientRepository as RepositoryInterface;

class ClientRepository implements RepositoryInterface
{
    public function __construct(private Model $model)
    {}

    public function firstOrCreate(array $client) : int 
    {
        
    }
}
