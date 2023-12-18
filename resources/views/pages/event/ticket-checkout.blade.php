@foreach ($eventDetails as $item)
    <p>{{ $item }}</p>
@endforeach
@foreach ($ticketCheckoutDetails as $item)
    <p>{{ $item['ticket_quantity'] }}</p>
    <p>{{ $item['event_date'] }}</p>
@endforeach
<p>Total ticket quantity: {{ $totalTicket }}</p>
<p>Total ticket price : {{ $totalPrice }}</p>