<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @include('pages.home.main-hero')
        @if (count($pilihanEvents) > 0)
            @include('pages.home.event-pilihan')
        @endif
        @include('pages.home.second-hero')
        @if (count($seminarEvents) > 0)
            @include('pages.home.event-seminar')
        @endif
        @if (count($pelatihanEvents) > 0)
            @include('pages.home.event-pelatihan')
        @endif
    </div>
    @include('components.footer')
</x-app-layout>
