<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg lg:text-4xl leading-tight">
            Create Ticket Event
        </h2>
        <h3 class="text-md lg:text-xl opacity-50">Lengkapi detail ticket untuk event</h3>
        <div class="mt-10">
            <ol class="flex flex-wrap gap-2 text-md lg:text-lg">
                @foreach (Breadcrumbs::generate('createEvent') as $breadcrumb)
                    @if (!is_null($breadcrumb->url) && !$loop->last)
                        <li class="opacity-70 hover:opacity-100"><a
                                href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                        <li>></li>
                    @else
                        <li class="breadcrumb-item">{{ $breadcrumb->title }}</li>
                    @endif
                @endforeach
            </ol>
        </div>
    </x-slot>
    <div class="mt-3 max-w-7xl mx-1 lg:px-8 xl:mx-auto h-auto">
        <h2 class="text-2xl font-bold mb-2">Detail Event</h2>
        <div class="bg-gray-200 p-5 mb-3">
            <div class="sm:grid  lg:grid-cols-3 sm:grid-cols-2">
                <div class="mb-5">
                    <p class="font-bold ">Event Name</p>
                    <p class="text-lg">{{ $event->title }}</p>
                </div>
                <div class="mb-5">
                    <p class="font-bold ">Organizer</p>
                    <p class="text-lg">{{ $event->organizer_name }}</p>
                </div>
                <div class="mb-5">
                    <p class="font-bold ">PIC Email</p>
                    <p class="text-lg">{{ $event->PIC_email }}</p>
                </div>
                <div class="mb-5">
                    <p class="font-bold ">PIC Phone</p>
                    <p class="text-lg">{{ $event->PIC_phone }}</p>
                </div>
                <div class="mb-5">
                    <p class="font-bold ">Tipe Event</p>
                    <p class="text-lg">{{ $event->type }}</p>
                </div>
                <div class="mb-5">
                    <p class="font-bold ">Total Day</p>
                    <p class="text-lg">{{ $event->total_day }}</p>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="mb-5">
                    <p class="font-bold ">Location</p>
                    <p class="text-lg">{{ $event->location }}</p>
                </div>
                <div class="mb-5">
                    <p class="font-bold">Description</p>
                    <p class="text-lg whitespace-pre-line">{{ $event->description }}</p>
                </div>
            </div>
        </div>
        <h2 class="text-2xl font-bold mb-2">Input Detail Ticket</h2>
        <div>
            <form action="{{ route('ticket.create', $event->slug) }}">
                <div class="mb-1">
                    <x-input-label for="ticket_type" :value="__('Jumlah tipe tiket (contoh: 2 untuk regular dan VIP)')" />
                    <x-text-input id="ticket_type" class="block mt-1 w-full" type="number" name="total_ticket_type"
                        max="5" :value="old('ticket_type')" required autofocus autocomplete="ticket_type" oninput="handleTotalTicketType()"/>
                </div>
                <h2 class="text-lg font-bold mb-1">Ticket Detail</h2>
                <div class="mb-1">
                    <x-input-label :value="__('Apakah Pengguna cukup membeli satu tiket untuk mengakses semua hari?')" />
                    <div>
                        <input type="radio" id="access_checked" class="access_checked" name="access_checked"
                            value="1" checked oninput="handleTotalTicketType()"/>
                        <label for="online">Ya</label>
                    </div>

                    <div>
                        <input type="radio" id="access_checked" class="access_checked" name="access_checked"
                            value="0" oninput="handleTotalTicketType()"/>
                        <label for="offline">Tidak</label>
                    </div>
                </div>
                <div id="ticketInputWrapper" class="">

                </div>
                <div class="hidden">
                    <input type="text" value="{{ $event->id }}" name="event_id">
                </div>
                <button type="submit"
                    class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800 mt-3">Buat
                    Ticket</button>
            </form>
        </div>
    </div>
    @include('components.footer')
    @push('javascript')
        <script>
            function ticketForm(i) {
                let value = `
                            <div class="bg-gray-200 p-5 mb-3 rounded-lg">
                                <p class="text-xl font-bold mb-2">Ticket Type ${i}</p>
                                <div class="flex gap-1">
                                    <div class="mb-1 flex-auto">
                                        <x-input-label for="name_${i}" :value="__('Nama Tiket')" />
                                        <x-text-input id="name_${i}" class="block mt-1 w-full" type="text" name="name[]"
                                            :value="old('name_${i}')" required autofocus autocomplete="name_${i}" />
                                    </div>
                                    <div class="mb-1 flex-auto">
                                    <x-input-label for="date_${i}" :value="__('Date')" />
                                        <x-text-input id="date_${i}" class="block mt-1 w-full" type="date" name="date[]"
                                            :value="old('date_${i}')" required autofocus autocomplete="date_${i}" min="{{ $event->start_date }}" value="{{ $event->start_date}}"/>
                                    </div>
                                    <div class="mb-1 flex-auto">
                                        <x-input-label for="ticket_price_${i}" :value="__('Harga Ticket')" />
                                        <x-text-input id="ticket_price_${i}" class="block mt-1 w-full" type="number" name="ticket_price[]"
                                            :value="old('ticket_price_${i}')" required autofocus autocomplete="ticket_price_${i}" />
                                    </div>
                                    <div class="mb-1 flex-auto">
                                        <x-input-label for="quantity_${i}" :value="__('Jumlah tiket yang dijual')" />
                                        <x-text-input id="quantity_${i}" class="block mt-1 w-full" type="number" name="quantity[]"
                                            :value="old('quantity_${i}')" required autofocus autocomplete="quantity_${i}" />
                                    </div>
                                </div>
                            </div>
                    `
                return value

            }

            function handleTotalTicketType() {
                let radioButtons = document.getElementsByName('access_checked');
                let radioButtonsValue;

                for (var i = 0; i < radioButtons.length; i++) {
                    if (radioButtons[i].checked) {
                        radioButtonsValue = radioButtons[i].value;
                        break;
                    }
                }

                console.log(radioButtonsValue);

                let ticketTypeValue = document.getElementById('ticket_type').value;

                let ticketInputWrapper = document.getElementById('ticketInputWrapper');

                if (ticketTypeValue > 5) {
                    Swal.fire({
                        icon: "error",
                        title: "Opps..",
                        text: "Maksimal tipe tiket adalah 5",
                    });
                } else {
                    document.getElementById('ticketInputWrapper').innerHTML = '';

                    for (let i = 1; i <= ticketTypeValue; i++) {
                        // Create ticket input elements
                        let ticketInput = document.createElement('div');
                        if (radioButtonsValue == 0) {
                            ticketInput.innerHTML = `
                                @for ($x = 1; $x <= $event->total_day; $x++)
                                <p class="text-2xl font-bold mb-2">Ticket Day {{ $x }}</p>
                                    ${ticketForm(i)}
                                @endfor
                            `;
                        } else {
                            ticketInput.innerHTML = `
                                <p class="text-2xl font-bold mb-2">One Ticket All Day</p>
                                ${ticketForm(i)}
                            `;
                        }


                        // Append the new ticket input elements to the wrapper
                        document.getElementById('ticketInputWrapper').appendChild(ticketInput);
                    }
                }


            }
        </script>
    @endpush
</x-app-layout>
