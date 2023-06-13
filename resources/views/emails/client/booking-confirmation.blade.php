<x-mail::message>
# Booking Confirmation

<x-mail::panel>
    Hello {{$client->getName()}}, Thank you for booking
</x-mail::panel>

<x-mail::table>
| Vehicle Make  | {{$vehicle->getMake()}}  |
| Vehicle Model | {{$vehicle->getModel()}} |
</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>