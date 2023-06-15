<x-mail::message>
# Booking Confirmation

<x-mail::panel>
    Hello {{$client->getName()}}, Thank you for booking
</x-mail::panel>

<x-mail::table>
    | Date   | {{$booking->date}}   |
</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>