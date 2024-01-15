<div class="gap-3 mt-3" id="ticketSection">
    <p class="text-2xl md:text-4xl font-bold mb-5">Ticket</p>
    <div class="flex gap-3">
        <div class="w-full px-2 sm:px-0 max-w-[811px] xl:min-w-[811px] rounded-lg">
            <form action="{{ route('ticket.checkout', [$event->type, $event->slug]) }}" method="POST"
                enctype="multipart/form-data" onsubmit="return handleSelectChange()">
                @csrf

                @foreach ($eventTickets as $eventTicket)
                    <div class="p-5 bg-[#D5E9F2] mb-2 rounded">
                        <p class="text-xl mb-2"><span
                                class="font-bold">{{ date('D, d M y', strtotime($eventTicket->date)) }}</span>
                        </p>
                        <p>type: <span class="font-bold">{{ $eventTicket->name }}</span></p>
                        <p>price: <span
                                class="font-bold">{{ $eventTicket->ticket_price == null ? 'Gratis' : 'Rp. ' . number_format($eventTicket->ticket_price, 2, ',', '.') }}</span>
                        </p>

                        <label for="{{ $eventTicket->id }}_{{ $eventTicket->name }}">Ticket
                            quantity:</label>
                        <select id="{{ $eventTicket->id }}_{{ $eventTicket->name }}" class="ticket_selected border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
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
