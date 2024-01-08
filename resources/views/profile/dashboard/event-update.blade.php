<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Update Event Information') }}
        </h2>
    </x-slot>

    <div class="mt-3 max-w-7xl mx-1 lg:px-8 xl:mx-auto">
        @if ($errors->any())
            <div
                class="my-6 p-6 leading-tight text-orange-700 bg-orange-100 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('user.event.update', $event->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')

            <h2 class="my-6 text-2xl font-semibold">
                Detail Event
            </h2>
            <div class="grid md:grid-cols-2 xl:grid-cols-4 mb-4">
                <div>
                    <p class="text-lg font-semibold mb-2">Event Potrait Poster</p>
                    @if ($event->potrait_banner)
                        <img src="{{ asset('images/potraitBanner/' . $event->potrait_banner) }}" alt=""
                            class="w-56" id="potrait-poster" onclick="showPotraitPoster()">
                        <p for="potrait_banner" :value="__('Potrait banner (rekomendasi ukuran 324px x 405px)')" />
                        <input type="file" name="potrait_banner" id="">
                        <x-input-error :messages="$errors->get('potrait_banner')" class="mt-2" />
                    @else
                        <p class="text-lg text-gray-700 mb-2">poster tidak ditemukan</p>
                        <p for="potrait_banner" :value="__('Potrait banner (rekomendasi ukuran 324px x 405px)')" />
                        <input type="file" name="potrait_banner" id="">
                        <x-input-error :messages="$errors->get('potrait_banner')" class="mt-2" />
                    @endif

                </div>
                <div>
                    <p class="text-lg font-semibold mb-2">Event Landscape Poster</p>
                    @if ($event->landscape_banner)
                        <img src="{{ asset('images/landscapeBanner/' . $event->landscape_banner) }}" alt=""
                            id="landscape-poster" onclick="showLandscapePoster()">
                        <input type="file" name="landscape_banner" id="">
                        <x-input-error :messages="$errors->get('landscape_banner')" class="mt-2" />
                    @else
                        <p class="text-lg text-gray-700 mb-2">poster tidak ditemukan</p>
                        <p for="landscape_banner" :value="__('Landscape banner (rekomendasi ukuran 811px x 374px)')" />
                        <input type="file" name="landscape_banner" id="">
                        <x-input-error :messages="$errors->get('landscape_banner')" class="mt-2" />
                    @endif
                </div>
            </div>
            <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-4">
                <div class="mb-2">
                    <p class="text-lg font-semibold mb-2" for="title">Nama Event</p>
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                        value="{{ $event->title }}" required autofocus autocomplete="title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <p class="text-lg font-semibold mb-2">Organizer</p>
                    <x-text-input id="organizer_name" class="block mt-1 w-full" type="text" name="organizer_name"
                        value="{{ $event->organizer_name }}" required autofocus autocomplete="orgnainzer_name" />
                    <x-input-error :messages="$errors->get('organizer_name')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <p class="text-lg font-semibold mb-2">PIC Email</p>
                    <x-text-input id="organizer_email" class="block mt-1 w-full" type="email" name="PIC_email"
                        value="{{ $event->PIC_email }}" required autofocus autocomplete="organizer_email" />
                    <x-input-error :messages="$errors->get('PIC_email')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <p class="text-lg font-semibold mb-2">PIC Phone</p>
                    <x-text-input id="PIC_phone" class="block mt-1 w-full" type="text" name="PIC_phone"
                        value="{{ $event->PIC_phone }}" required autofocus autocomplete="organizer_phone"
                        placeholder="+628xxx" />
                    <x-input-error :messages="$errors->get('PIC_phone')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <p class="text-lg font-semibold mb-2">Tipe Event</p>
                    @foreach (App\Enum\EventTypeEnum::toArray() as $key => $value)
                        <div>
                            <input type="radio" id="{{ $value }}_checked" name="type"
                                value="{{ $value }}" {{ $event->type == $value ? 'checked' : '' }} />
                            <label for="{{ $value }}">{{ $value }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="mb-2">
                    <p class="text-lg font-semibold mb-2">Is Online</p>
                    <div>
                        <input type="radio" id="online_checked" name="is_online" value="1"
                            {{ $event->is_online == 1 ? 'checked' : '' }} />
                        <label for="online">Online</label>
                    </div>

                    <div>
                        <input type="radio" id="offline_checked" name="is_online" value="0"
                            {{ $event->is_online == 0 ? 'checked' : '' }} />
                        <label for="offline">Offline</label>
                    </div>
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
                    <p class="text-lg font-semibold mb-2">Location/Link</p>
                    <textarea id="location" rows="4"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        type="text" name="location" required autofocus autocomplete="location">{{ $event->location }}</textarea>
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
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
                <input type="text" class="hidden" value="{{ $event->status == App\Enum\EventCuratedStatusEnum::PENDING->value ? App\Enum\EventCuratedStatusEnum::APPROVED->value : App\Enum\EventCuratedStatusEnum::PENDING->value }}" name="status">
                <div class="mb-2">
                    <p class="text-lg font-semibold mb-2">Is Publish</p>
                    <div>
                        <input type="radio" id="online_checked" name="is_publish" value="1"
                            {{ $event->is_publish == 1 ? 'checked' : '' }} />
                        <label for="online">Publish</label>
                    </div>

                    <div>
                        <input type="radio" id="offline_checked" name="is_publish" value="0"
                            {{ $event->is_publish == 0 ? 'checked' : '' }} />
                        <label for="offline">Not Publish</label>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 mb-4">
                <div class="">
                    <p class="text-lg font-semibold">Description</p><br>
                    <textarea class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        rows="4" name="description">{{ $event->description }}</textarea>
                </div>
            </div>

            <button type="submit"
                class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800">Update</button>
        </form>
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
                    <p class="text-lg text-gray-700">Quantity: <span
                            class="">{{ $eventTicket->quantity }}</span>
                    </p>
                </div>
            @endforeach
        </div>
</x-app-layout>
