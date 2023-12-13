<x-app-layout>
    @include('pages.event.detail.event-detail-header')

    <div class="mt-3 max-w-7xl mx-1 lg:px-8 xl:mx-auto h-auto">
        @include('pages.event.detail.event-detail-first-row')
        @include('pages.event.detail.event-detail-second-row')
    </div>
    <div class="">
        @include('components.footer')
    </div>
</x-app-layout>


