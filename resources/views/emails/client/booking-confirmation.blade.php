<x-mail::message>
# Booking Confirmation

<x-mail::panel>
    Hello {{$client->getName()}}, Thank you for booking
</x-mail::panel>

<x-mail::table>
| Vehicle Make  | {{$vehicle->getName()}} |
| Vehicle Model | {{$vehicle->getName()}} |
| Slot Start    | {{$date->getStart()}}   |
| Slot End      | {{$date->getEnd()}}     |
</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>