<div class="gap-3 mt-3">
    <p class="text-2xl md:text-4xl font-bold mb-5">Ticket</p>
    <div class="tickets">
        @if (count($eventTickets) > 0)
            @for ($i = 0; $i < $event->total_day; $i++)
                <div>
                    <p class="ext-md lg:text-lg">Ticket day:
                        {{ date('D, d M y', strtotime($event->start_date . ' + ' . $i . ' days')) }}</p>
                    @foreach ($eventTickets as $eventTicket)
                        <p>{{ $eventTicket->name }}</p>
                        <p>{{ $eventTicket->type }}</p>
                        <p>{{ $eventTicket->ticket_price == null ? 'Gratis' : 'Rp. ' . number_format($eventTicket->ticket_price, 2, ',', '.') }}
                        </p>

                        <label for="ticket_quantity">Ticket quantity:</label>

                        <select name="ticket_quantity" id="ticket_quantity" class="rounded-lg">
                            <option value="1">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    @endforeach
                </div>
            @endfor

            <div class="mt-3">
                <a href="#daftarEvent"
                    class="py-2 px-5 border-2 border-black rounded text-lg xl:text-xl text-gray-200 bg-gray-800">Beli
                    Tiket</a>
            </div>
        @else
            <p class="ext-md lg:text-lg">Event ini gratis tanpa perlu membeli tiket</p>
        @endif
    </div>
</div>
