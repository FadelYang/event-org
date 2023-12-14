<div class="gap-3 mt-3">
    <p class="text-2xl md:text-4xl font-bold mb-5">Ticket</p>
    <div class="tickets">
        @if (count($eventTickets) > 0)
            @for ($i = 0; $i < $event->total_day; $i++)
                <div>
                    <p class="ext-md lg:text-lg">Ticket day: {{ date('D, d M y', strtotime($event->start_date . ' + ' . $i . ' days')) }}</p>
                    @foreach ($eventTickets as $eventTicket)
                        <p>{{ $eventTicket->name }}</p>
                        <p>{{ $eventTicket->type }}</p>
                        <p>{{ $eventTicket->ticket_price == null ? 'Gratis' : 'Rp. ' . number_format($eventTicket->ticket_price, 2, ',', '.') }}</p>
                    @endforeach
                </div>
            @endfor
        @else
            <p class="ext-md lg:text-lg">Tidak ada info penjualan tiket</p>
        @endif
    </div>
</div>
