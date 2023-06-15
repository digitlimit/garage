@php
    $booking = (object) $booking;
@endphp
<x-mail::message>
# New Booking 

<x-mail::panel>
    The booking below was just created.
</x-mail::panel>

Name  : {{ $booking->name }} \
Email : {{ $booking->email }}\
Phone : {{ $booking->phone }}\
Make  : {{ $booking->make }}\
Model : {{ $booking->model }}\
Slot  : {{ $booking->slot }}

<x-mail::button :url="'/bookings'">
    View Bookings
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>