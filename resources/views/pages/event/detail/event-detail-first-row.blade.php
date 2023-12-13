<div class="block xl:flex gap-3">
    <img src="{{ fake()->imageUrl($width = 811, $height = 374) }}" alt=""
        class="w-full bg-black max-h-[374px] max-w-[811px] rounded-lg">
    <div
        class="bg-gray-200 px-2 sm:px-4 py-5 w-full max-h-[374px] max-w-[811px] rounded-lg mt-3 xl:mt-0 flex flex-col gap-3">
        <p class="text-2xl lg:text-4xl font-bold mb-2 lg:mb-5">{{ $event->title }}</p>
        <div class="flex gap-3">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z">
                </path>
            </svg>
            <p>{{ date('D, d M y', strtotime($event->start_date)) }}</p>
            <p>-</p>
            <p>{{ date('D, d M y', strtotime($event->start_date . ' + ' . $event->total_day . ' days')) }}</p>
        </div>
        <div class="flex gap-3 mb-auto">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
            </svg>
            <p>{{ $event->location }}</p>
        </div>
        <div class="event-organizer flex items-center gap-3 mt-1 py-2 border-t-2 border-gray-500">
            <img src="" alt="" class="rounded-full image-profile-user-placeholder">
            <p class="text-lg">{{ $event->eventCreator->name }}</p>
        </div>
    </div>
</div>