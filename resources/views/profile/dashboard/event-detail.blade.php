<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mt-3 max-w-7xl mx-1 lg:px-8 xl:mx-auto">
        <div id="alert-wrapper">
            @if ($errors->any())
                <div class="my-6 p-6 leading-tight text-red-500 bg-red-200 rounded-l">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @if ($event->status == App\Enum\EventCuratedStatusEnum::APPROVED->value)
            <div
                class="my-6 p-6 leading-tight text-green-700 bg-green-100 rounded-lg">
                <p>Event ini sudah dikurasi dan tayang</p>
            </div>
        @elseif ($event->status == App\Enum\EventCuratedStatusEnum::PENDING->value)
            <div
                class="my-6 p-6 leading-tight text-orange-700 bg-orange-100 rounded-lg">
                <p>Event ini belum dikurasi dan belum tayang.</p>
            </div>
        @else
            <div class="my-6 p-6 leading-tight bg-red-200 text-red-500 rounded-l rounded-lg">
                <p>Event ini sudah dikurasi dan ditolak, alasan penolakan</p>
                <ul class="ms-5 list-disc">
                    <li>{{ $event->cancel_statement }}</li>
                </ul>
                <p class="text-red-700 underline mt-2"><a
                        href="{{ route('user.event.detail', [Auth::user()->name, $event->type, $event->slug]) }}">Update
                        informasi event</a></p>
            </div>
        @endif

        <h2 class="my-6 text-2xl font-semibold">
            Detail Event
        </h2>
        <div class="grid md:grid-cols-2 xl:grid-cols-4 mb-4">
            <div>
                <p class="text-lg font-semibold mb-2">Event Potrait Poster</p>
                @if ($event->potrait_banner)
                    <img src="{{ asset('images/potraitBanner/' . $event->potrait_banner) }}" alt=""
                        class="w-56" id="potrait-poster" onclick="showPotraitPoster()">
                @else
                    <p class="text-lg text-gray-700 mb-2">poster tidak ditemukan</p>
                @endif

            </div>
            <div>
                <p class="text-lg font-semibold mb-2">Event Landscape Poster</p>
                @if ($event->landscape_banner)
                    <img src="{{ asset('images/landscapeBanner/' . $event->landscape_banner) }}" alt=""
                        id="landscape-poster" onclick="showLandscapePoster()">
                @else
                    <p class="text-lg text-gray-700 mb-2">poster tidak ditemukan</p>
                @endif
            </div>
        </div>
        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-4">
            <div class="mb-2">
                <p class="text-lg font-semibold mb-2">Event Name</p>
                <p class="text-lg text-gray-700 mb-2">{{ $event->title }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold mb-2">Organizer</p>
                <p class="text-lg text-gray-700 mb-2">{{ $event->organizer_name }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold mb-2">PIC Email</p>
                <p class="text-lg text-gray-700 mb-2">{{ $event->PIC_email }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold mb-2">PIC Phone</p>
                <p class="text-lg text-gray-700 mb-2">{{ $event->PIC_phone }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold mb-2">Tipe Event</p>
                <p class="text-lg text-gray-700 mb-2">{{ $event->type }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold mb-2">Start Date</p>
                <p class="text-lg text-gray-700 mb-2">
                    {{ date('D, d M y', strtotime($event->start_date)) }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold mb-2">End Date</p>
                <p class="text-lg text-gray-700 mb-2">
                    {{ date('D, d M y', strtotime($event->start_date . ' + ' . $event->total_day . ' days')) }}</p>
            </div>

            <div class="mb-2">
                <p class="text-lg font-semibold mb-2">Location</p>
                <p class="text-lg text-gray-700 mb-2">{{ $event->location }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold mb-2">Status</p>
                @if ($event->status == App\Enum\EventCuratedStatusEnum::APPROVED->value)
                    <p><span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">Approved</span>
                    </p>
                @elseif($event->status == App\Enum\EventCuratedStatusEnum::PENDING->value)
                    <p>
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full">Pending</span>
                    </p>
                @else
                    <p><span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">Reject</span>
                    </p>
                @endif
            </div>

            <div class="mb-2">
                <p class="text-lg font-semibold mb-2">Is Publish</p>
                @if ($event->is_publish == 1)
                    <p><span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">publish</span>
                    </p>
                @else
                    <p><span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">Not
                            publish</span>
                    </p>
                @endif
            </div>
        </div>
        <div class="grid grid-cols-1 mb-4">
            <div class="">
                <p class="text-lg font-semibold">Description</p>
                <p class="text-lg text-gray-700 event-description-text">
                    {{ $event->description }}</p>
            </div>
        </div>
        @if ($event->status != App\Enum\EventCuratedStatusEnum::PENDING->value)
            
        @endif
        <a href="{{ route('user.event.detail.update', [Auth::user()->name, $event->type, $event->slug]) }}" class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800">Update Event</a>
        <h2 class="my-6 text-2xl font-semibold">
            Detail Event Ticket
        </h2>
        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-2">
            @foreach ($eventTickets as $eventTicket)
                <div class="mb-2">
                    <p class="text-lg font-semibold"><span
                            class="font-bold">{{ date('D, d M y', strtotime($eventTicket->date)) }}</span>
                    </p>
                    <p class="text-lg text-gray-700">Name: <span class="">{{ $eventTicket->name }}</span></p>
                    <p class="text-lg text-gray-700">price: <span
                            class="">{{ $eventTicket->ticket_price == null ? 'Gratis' : 'Rp. ' . number_format($eventTicket->ticket_price, 2, ',', '.') }}</span>
                    </p>
                    <p class="text-lg text-gray-700">Quantity: <span class="">{{ $eventTicket->quantity }}</span>
                    </p>
                </div>
            @endforeach
        </div>
</x-app-layout>
