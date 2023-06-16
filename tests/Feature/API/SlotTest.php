<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can allow guests to fetch slots', function () 
{

})->group('api', 'api-slot', 'api-slot-list');


it('can allow guests to fetch list of closed slots', function () 
{

})->group('api', 'api-slot', 'api-fetch-closed-slots');


it('can allow guests to fetch list of closed dates', function () 
{

})->group('api', 'api-slot', 'api-fetch-closed-dates');


it('can allow guests to fetch list of booked dates', function () 
{

})->group('api', 'api-slot', 'api-fetch-booked-dates');


it('can block a slot from being booked', function () 
{

})->group('api', 'api-slot', 'api-slot-block-slot');

it('can block a date from being booked', function () 
{

})->group('api', 'api-slot', 'api-slot-block-date');




