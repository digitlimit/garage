<x-mail::message>
# New Booking 

<x-mail::panel>
    The booking below was just created.
</x-mail::panel>

<x-mail::table>
| Date   | {{$booking->date}}   |
</x-mail::table>

<x-mail::button :url="$url">
    View Booking
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>