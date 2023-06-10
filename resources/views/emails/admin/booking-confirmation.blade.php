<x-mail::message>
# New Booking 

<x-mail::panel>
    The booking below was just created.
</x-mail::panel>

<x-mail::table>
| Client Name   | {{$client->getName()}}  |
| Client Phone  | {{$client->getName()}}  |
| Client Email  | {{$client->getName()}}  |
| Vehicle Make  | {{$vehicle->getName()}} |
| Vehicle Model | {{$vehicle->getName()}} |
| Slot Start    | {{$date->getStart()}}   |
| Slot End      | {{$date->getEnd()}}     |
</x-mail::table>

<x-mail::button :url="$url">
    View Booking
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>