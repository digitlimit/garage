<x-mail::message>
# New Booking 

<x-mail::panel>
    The booking below was just created.
</x-mail::panel>

<x-mail::table>
| Client Name   | {{$client->getName()}}   |
| Client Phone  | {{$client->getPhone()}}  |
| Client Email  | {{$client->getEmail()}}  |
| Vehicle Make  | {{$vehicle->getMake()}}  |
| Vehicle Model | {{$vehicle->getModel()}} |
</x-mail::table>

<x-mail::button :url="$url">
    View Booking
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>