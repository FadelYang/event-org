@extends('layouts.admin')
@section('content')
    <div class="container px-6 mx-auto">
        <div id="alert-wrapper">
            @if ($errors->any())
                <div
                    class="my-6 p-6 leading-tight text-orange-700 bg-orange-100 rounded-lg dark:text-white dark:bg-orange-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @if ($event->status == App\Enum\EventCuratedStatusEnum::APPROVED->value)
            <div class="my-6 p-6 leading-tight text-green-700 bg-green-100 rounded-lg dark:bg-green-700 dark:text-green-100">
                <p>Event ini sudah dikurasi dan tayang</p>
            </div>
        @elseif ($event->status == App\Enum\EventCuratedStatusEnum::PENDING->value)
            <div class="my-6 p-6 leading-tight text-orange-700 bg-orange-100 rounded-lg dark:text-white dark:bg-orange-600">
                <p>Event ini belum dikurasi dan belum tayang.</p>
            </div>
        @else
            <div class="my-6 p-6 leading-tighttext-red-500 bg-red-200 text-red-500 rounded-l rounded-lg">
                <p>Event ini sudah dikurasi dan ditolak, alasan penolakan</p>
                <ul class="ms-5 list-disc">
                    <li>{{ $event->cancel_statement }}</li>
                </ul>
                <p class="text-red-700 underline mt-2"><a
                        href="{{ route('user.event.detail', [Auth::user()->name, $event->type, $event->slug]) }}">Update
                        informasi event</a></p>
            </div>
        @endif

        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Detaill Event
        </h2>
        <div class="grid md:grid-cols-2 xl:grid-cols-4 mb-2">
            <div>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Event Potrait Poster</p>
                @if ($event->potrait_banner)
                    <img src="{{ asset('images/potraitBanner/' . $event->potrait_banner) }}" alt="" class="w-56"
                        id="potrait-poster" onclick="showPotraitPoster()">
                @else
                    <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">poster tidak ditemukan</p>
                @endif

            </div>
            <div>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Event Landscape Poster</p>
                @if ($event->landscape_banner)
                    <img src="{{ asset('images/landscapeBanner/' . $event->landscape_banner) }}" alt=""
                        id="landscape-poster" onclick="showLandscapePoster()">
                @else
                    <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">poster tidak ditemukan</p>
                @endif
            </div>
        </div>
        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-4">
            <div class="mb-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Event Name</p>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">{{ $event->title }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Organizer</p>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">{{ $event->organizer_name }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">PIC Email</p>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">{{ $event->PIC_email }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">PIC Phone</p>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">{{ $event->PIC_phone }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Tipe Event</p>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">{{ $event->type }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Start Date</p>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">
                    {{ date('D, d M y', strtotime($event->start_date)) }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">End Date</p>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">
                    {{ date('D, d M y', strtotime($event->start_date . ' + ' . $event->total_day . ' days')) }}</p>
            </div>

            <div class="mb-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Location</p>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">{{ $event->location }}</p>
            </div>
            <div class="mb-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Status</p>
                @if ($event->status == App\Enum\EventCuratedStatusEnum::APPROVED->value)
                    <p><span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Approved</span>
                    </p>
                @elseif($event->status == App\Enum\EventCuratedStatusEnum::PENDING->value)
                    <p>
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">Pending</span>
                    </p>
                @else
                    <p><span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">Reject</span>
                    </p>
                @endif
            </div>

            <div class="mb-2">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Is Publish</p>
                @if ($event->is_publish == 1)
                    <p><span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">publish</span>
                    </p>
                @else
                    <p><span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">Not
                            publish</span>
                    </p>
                @endif
            </div>
        </div>
        <div class="grid grid-cols-1 mb-4">
            <div class="">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">Description</p>
                <p class="text-lg text-gray-500 dark:text-gray-400 event-description-text">
                    {{ $event->description }}</p>
            </div>
        </div>
        <h2 class="my-6 dtext-2xl font-semibold text-gray-700 dark:text-gray-200">
            Detaill Event Ticket
        </h2>
        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-2">
            @foreach ($eventTickets as $eventTicket)
                <div class="mb-2">
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><span
                            class="font-bold">{{ date('D, d M y', strtotime($eventTicket->date)) }}</span>
                    </p>
                    <p class="text-lg text-gray-500 dark:text-gray-400">Name: <span
                            class="">{{ $eventTicket->name }}</span></p>
                    <p class="text-lg text-gray-500 dark:text-gray-400">price: <span
                            class="">{{ $eventTicket->ticket_price == null ? 'Gratis' : 'Rp. ' . number_format($eventTicket->ticket_price, 2, ',', '.') }}</span>
                    </p>
                    <p class="text-lg text-gray-500 dark:text-gray-400">Quantity: <span
                            class="">{{ $eventTicket->quantity }}</span></p>
                </div>
            @endforeach
        </div>
        <div class="mb-2">
            <form action="{{ route('admin.approve-and-publish-event', $event->id) }}" id="curating-form"
                onclick="eventCuratedConfirmation(event)" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <button type="submit" id="curating-form-button"
                    class="mb-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Terbitkan Event
                </button>
            </form>
            <form action="{{ route('admin.reject-submitted-event', $event->id) }}" id="cancel-curating-form"
                onclick="cancelEventCuratedConfirmation(event)" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="text" class="hidden" id="rejection-reason" name="cancel_statement">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-500 hover:bg-red-500 focus:outline-none focus:shadow-outline-purple">
                    Cancel Event
                </button>
            </form>
        </div>

        @include('admin.pages.event.cancel-statement-modal')
    @endsection

    @push('javascript')
        <script>
            function eventCuratedConfirmation(event) {
                event.preventDefault()

                let form = document.getElementById('curating-form');
                let isEventApproved =
                    {{ $event->status == App\Enum\EventCuratedStatusEnum::APPROVED->value ? 'true' : 'false' }};

                if (isEventApproved) {
                    Swal.fire({
                        title: "Event sudah dikurasi",
                        text: "event ini sudah dikurasi dan sudah terbit",
                        icon: "info"
                    });
                } else {
                    Swal.fire({
                        title: "Apakah kamu yakin?",
                        text: "Event ini akan diterbitkan dan muncul di halaman depan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, terbitkan!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit the form only if the user confirms
                            form.submit();
                        }
                    });
                }
            }


            function cancelEventCuratedConfirmation(event) {
                event.preventDefault()

                let rejectionForm = document.getElementById('cancel-curating-form')
                let rejectionInput = document.getElementById('rejection-reason')

                Swal.fire({
                    title: "Apakah kamu yakin?",
                    text: "Pengguna akan mendapat pemberitahuan mengenai penolakan pendaftaran event!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Tolak!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Masukkan alasan penolakan",
                            input: "text",
                            inputValidator: (value) => {
                                if (!value) {
                                    return "Alasan penolakan wajib diisi!";
                                }
                            },
                            inputAttributes: {
                                autocapitalize: "off"
                            },
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            showCancelButton: true,
                            confirmButtonText: "Ya, Tolak",
                            showLoaderOnConfirm: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let rejectionReason = result.value;

                                rejectionInput.value = rejectionReason

                                rejectionForm.submit()
                            }
                        });
                    }
                })
            }
        </script>

        <script>
            let alertWrapper = document.getElementById('alert-wrapper');

            setTimeout(function() {
                alertWrapper.style.display = 'none';
            }, 5000);
        </script>

        <script>
            function showPotraitPoster() {
                let potraitPoster = document.getElementById('potrait-poster').src;

                Swal.fire({
                    imageUrl: potraitPoster
                })
            }

            function showLandscapePoster() {
                let landscapePoster = document.getElementById('landscape-poster').src;

                Swal.fire({
                    imageUrl: landscapePoster
                })
            }
        </script>
    @endpush
