<div class="gap-3 mt-3" id="ticketSection">
    <p class="text-2xl md:text-4xl font-bold mb-5">Ticket</p>
    <div class="flex gap-3">
        <div class="w-full px-2 sm:px-0 max-w-[811px] xl:min-w-[811px] rounded-lg">
            <form action="{{ route('ticket.checkout', [$event->type, $event->slug]) }}" method="POST"
                enctype="multipart/form-data" onsubmit="return handleSelectChange()">
                @csrf

                @foreach ($eventTickets as $eventTicket)
                    <div class="p-10 bg-gray-400 mb-5 rounded">
                        <p class="ext-md lg:text-lg">Ticket day:
                            {{ date('D, d M y', strtotime($eventTicket->date)) }}</p>

                        <p>{{ $eventTicket->name }}</p>
                        <p>{{ $eventTicket->type }}</p>
                        <p>{{ $eventTicket->ticket_price == null ? 'Gratis' : 'Rp. ' . number_format($eventTicket->ticket_price, 2, ',', '.') }}
                        </p>

                        <label for="{{ $eventTicket->id }}_{{ $eventTicket->name }}">Ticket
                            quantity:</label>
                        <select id="{{ $eventTicket->id }}_{{ $eventTicket->name }}" class="ticket_selected"
                            name="ticket_selected[{{ $eventTicket->id }}]">
                            <option value="">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                @endforeach

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

            @foreach ($eventTickets as $eventTicket)
                var select = document.getElementById("{{ $eventTicket->id }}_{{ $eventTicket->name }}");

                if (select) {
                    totalSelected += parseInt(select.value) || 0;
                }
            @endforeach

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
