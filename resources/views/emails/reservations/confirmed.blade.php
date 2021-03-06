@component('mail::message')
Hello there,<br><br>{{ $message }}

@component('vendor.mail.html.panel')
<strong>{{ $room->roomType->name }} • {{ $room->name }}</strong><br>
![RoomImage](https://i.stack.imgur.com/bENi3.jpg)
Confirmation: <strong>{{ $reservation->unique_id }}</strong><br>
<strong>{{ $roomStay->start_date . ' / ' . $roomStay->end_date }}</strong><br>

Total: <strong>{{ $reservation->total_amount . ' ' . $reservation->currency }}</strong><br>
@endcomponent

@component('mail::button', ['url' => 'http://b-space.local:81'])
Checkin
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
