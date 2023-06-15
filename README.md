# SETUP

This document will serve as a setup guide for this appilcation.

## Requirements
- PHP ^8.1
- Laravel 10
- Docker
- Laravel Sail
- Composer

## Setup

1. From the root of the application install packages and dependcies by running
```
composer install
```
2. Copy .env 
```
cp .env.example .env
```

3. Start the Laravel sail docker container by running. 
```
sail up -d
```

This will try to run the application on the following ports
- 80    : Web server
- 3306  : MySQL server
- 6379  : Redis server
- 11211 : Memcached
- 1025  : Mailpit

4. Run migration and seeders
```
sail artisan migrate --seed
```
5. Setup Vue App
```
sail npm install
```
6. Build the Vue app
```
npm run build or npm run dev 
```

7. Accessing the application
Visit http://localhost

8. Running test
This application uses the Laravel Pest tests
```
sail artisan test
```

## API Endpoints

```
  POST      api/auth/login ........................... auth.login › API\AuthController@login
  POST      api/auth/logout .......................... auth.logout › API\AuthController@logout
  GET|HEAD  api/auth/user ............................ auth.user › API\AuthController@user
  POST      api/bookings ............................. bookings.create › API\BookingController@create
  GET|HEAD  api/bookings ............................. bookings.list › API\BookingController@list
  GET|HEAD  api/bookings/{booking} ................... bookings.view › API\BookingController@view
  GET|HEAD  api/slots ................................ slots.list › API\SlotController@list
  GET|HEAD  api/slots/booked-slots ................... slots.booked-slots › API\SlotController@BookedSlots
  POST      api/slots/close .......................... slots.close › API\SlotController@closeSlot
  GET|HEAD  api/slots/closed-dates ................... slots.closed-dates › API\SlotController@closedDates
  GET|HEAD  api/slots/closed-slots ................... slots.closed-slots › API\SlotController@closedSlots
  POST      api/slots/open ........................... slots.open › API\SlotController@openSlot
  GET|HEAD  sanctum/csrf-cookie ...................... sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show
```

NB: The .env will be commit for demo purpose
