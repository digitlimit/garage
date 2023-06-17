# SETUP

This document will serve as a setup guide for this appilcation.

## About this application
This is a simple Garage booking system built with Laravel and Vue3. It presents a booking form to the customers to book
a Garage based on slots availability.

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

## Emails
The application uses Mailpit for demo purpose.
This can be accessed here: http://localhost:8025/


NB: The .env is committed for demo purpose
## API Endpoints

```
  POST      api/auth/login .................................... auth.login › API\AuthController@login
  POST      api/auth/logout ................................... auth.logout › API\AuthController@logout
  GET|HEAD  api/auth/user ..................................... auth.user › API\AuthController@user
  POST      api/bookings ...................................... create › API\BookingController@create
  GET|HEAD  api/bookings ...................................... bookings.list › API\BookingController@list
  GET|HEAD  api/slots ......................................... slots.list › API\SlotController@list
  GET|HEAD  api/slots/booked-slots ............................ slots.booked-slots › API\SlotController@BookedSlots
  POST      api/slots/close-date .............................. slots.close.date › API\SlotController@closeDate
  POST      api/slots/close-slot .............................. slots.close.slot › API\SlotController@closeSlot
  GET|HEAD  api/slots/closed-dates ............................ slots.closed-dates › API\SlotController@closedDates
  GET|HEAD  api/slots/closed-slots ............................ slots.closed-slots › API\SlotController@closedSlots
  POST      api/slots/open-date ............................... slots.open.date › API\SlotController@openDate
  POST      api/slots/open-slot ............................... slots.open.slot › API\SlotController@openSlot
```

## Screenshots

### Tests
<img width="1417" alt="image" src="https://github.com/digitlimit/garage/assets/2041419/e868417b-8b74-4037-8fc1-52a71fbe4e84">

### VueApp

<img width="1434" alt="image" src="https://github.com/digitlimit/garage/assets/2041419/2c7cb71c-9b49-4369-b9fd-c15c38eaec67">

<img width="1437" alt="image" src="https://github.com/digitlimit/garage/assets/2041419/403bdb1c-3841-4c21-8062-920dd3b626f5">

![image](https://github.com/digitlimit/garage/assets/2041419/f4dce43b-29d5-4419-b3d4-3074dabeac6e)

![image](https://github.com/digitlimit/garage/assets/2041419/fb597bf1-3bdb-4d1e-96ea-38f3a69f175f)

![image](https://github.com/digitlimit/garage/assets/2041419/d420730a-ff7e-47c9-8f82-f3f99e73d336)

![image](https://github.com/digitlimit/garage/assets/2041419/7a389aaa-2c9c-4e56-afa9-700384d200b9)

![image](https://github.com/digitlimit/garage/assets/2041419/5aa7f381-59ac-411e-a73e-af7b72f08a61)

![image](https://github.com/digitlimit/garage/assets/2041419/89d2d693-83ac-44ed-9306-b855a74e1746)




