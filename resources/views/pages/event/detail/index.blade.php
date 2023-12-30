<x-app-layout>
    @include('pages.event.detail.event-detail-header')

    <div class="mt-3 max-w-7xl mx-1 lg:px-8 xl:mx-auto">
        @include('pages.event.detail.event-detail-first-row')
        @include('pages.event.detail.event-detail-second-row')
        @if (count($eventTickets) > 0)
            @include('pages.event.detail.ticket-section')
        @else
            <p class="text-md lg:text-lg mt-5">Belum ada info penjualan tiket</p>
        @endif
    </div>
    @include('components.footer')
</x-app-layout>
