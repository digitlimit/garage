<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can login in a user', function () 
{

})->group('api', 'api-auth', 'authenticate');
