@php
    $booking = (object) $booking;
@endphp

<x-mail::message>
# Booking Confirmation

<x-mail::panel>
    Hello {{ $booking->name }},
    This is just to confirm we recieved your booking.
</x-mail::panel>

# Booking Detials:

Make  : {{ $booking->make }}\
Model : {{ $booking->model }}\
Slot  : {{ $booking->slot }}

Please don't miss your slot. 

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>