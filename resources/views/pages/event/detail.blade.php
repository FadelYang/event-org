<x-app-layout>
    @include('pages.event.event-detail-header')

    <div class="block xl:flex gap-3 mt-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <img src="{{ fake()->imageUrl($width=811, $height=374) }}" alt=""
            class="w-full bg-black max-h-[374px] max-w-[811px] rounded-lg">
        <div class="bg-gray-200 px-10 py-5 w-full max-h-[374px] max-w-[811px] rounded-lg mt-3 xl:mt-0">
            <p>{{ $event->title }}</p>
            <div class="flex gap-3">
                <p>{{ date('D, d M y', strtotime($event->start_date)) }}</p>
                <p>-</p>
                <p>{{ date('D, d M y', strtotime($event->end_date)) }}</p>
            </div>
            <p>{{ $event->location }}</p>

        </div>
    </div>
</x-app-layout>
