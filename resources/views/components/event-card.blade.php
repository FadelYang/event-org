<div class="event-card bg-gray-200 max-w-sm md:max-w-xs rounded-xl min-w-max snap-center">
    <a href="#detailEventUrl">
        <img src="{{ fake()->imageUrl($width = 328, $height = 220) }}" alt="" class="w-full rounded-t-xl">
    </a>
    <div class="event-card-detail mx-2">
        <div class="flex mt-1 between">
            <p class="text-xl font-bold me-auto">Nama Event</p>
            <p class="text-lg font-bold">Online</p>
        </div>
        <div class="mt-1">
            <p class="text-lg text-gray-500">{{ fake()->date('d M Y') }}</p>
            <p class="mt-3 font-bold text-lg">Gratis</p>
        </div>
        <div class="event-organizer flex items-center gap-3 mt-1 py-2 border-t-2 border-gray-500">
            <img src="{{ fake()->imageUrl($width = 35, $height = 35) }}" alt="" class="rounded-full">
            <p class="text-lg">{{ fake()->name() }}</p>
        </div>
    </div>
</div>
