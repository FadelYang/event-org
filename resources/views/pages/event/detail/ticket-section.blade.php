<div class="gap-3 mt-3" id="ticketSection">
    <p class="text-2xl md:text-4xl font-bold mb-5">Ticket</p>
    <div class="flex gap-3">
        <div class="w-full px-2 sm:px-0 max-w-[811px] xl:min-w-[811px] rounded-lg">
            <form action="{{ route('ticket.checkout', [$event->type, $event->slug]) }}" method="POST"
                enctype="multipart/form-data" onsubmit="return handleSelectChange()">
                @csrf
                @for ($i = 0; $i <= $event->total_day; $i++)
                    <div class="p-10 bg-gray-400 mb-5 rounded">
                        <p class="hidden" id="eventTotalDay">{{ $event->total_day }}</p>
                        <p class="ext-md lg:text-lg">Ticket day:
                            {{ date('D, d M y', strtotime($event->start_date . ' + ' . $i . ' days')) }}</p>
                        @foreach ($eventTickets as $eventTicket)
                            <p>{{ $eventTicket->name }}</p>
                            <p>{{ $eventTicket->type }}</p>
                            <p>{{ $eventTicket->ticket_price == null ? 'Gratis' : 'Rp. ' . number_format($eventTicket->ticket_price, 2, ',', '.') }}
                            </p>

                            <div class="hidden">
                                <input type="text" name="ticket_id" value="{{ $eventTicket->id }}">
                                <input type="text" name="ticket_name" value="{{ $eventTicket->name }}">
                                <input type="text" name="ticket_type" value="{{ $eventTicket->type }}">
                                <input type="text" name="ticket_price" value="{{ $eventTicket->ticket_price }}">
                                <input type="text" name="event_name" value="{{ $event->title }}">
                                <input type="text" name="event_date" value="{{ $event->start_date }}">
                            </div>

                            <label for="day_{{ $i }}_ticket_quantity">Ticket quantity:</label>
                            <select id="day_{{ $i }}_ticket_quantity" class="rounded"
                                name="days[{{ $i }}]">
                                <option value="">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        @endforeach
                    </div>
                @endfor

                <div class="mt-3">
                    <button type="submit"
                        class="py-2 px-5 border-2 border-black rounded text-lg xl:text-xl text-gray-200 bg-gray-800">Beli
                        Tiket</button>
                </div>
            </form>

        </div>
        <div>

        </div>
    </div>
</div>

@push('javascript')
    <script>
        function handleSelectChange(selectElement) {
            var totalSelected = 0;

            var totalDay = parseInt(document.getElementById("eventTotalDay").innerText);
            for (var i = 0; i <= totalDay; i++) {
                var select = document.getElementById("day_" + i + "_ticket_quantity");
                totalSelected += parseInt(select.value) || 0;
            }

            console.log(totalSelected);

            if (totalSelected < 1) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Pembelian tiket minimal satu",
                });
                return false;
            }

            return true;
        }
    </script>
@endpush
