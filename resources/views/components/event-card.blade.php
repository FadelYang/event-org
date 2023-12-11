<div class="event-card bg-gray-200 max-w-sm md:max-w-xs rounded-xl min-w-max snap-center">
    <a href="{{ route('event.detail', $item->slug) }}">
        <img src="" alt=""
            class="w-full rounded-t-xl max-w-[324px] max-h-[405px] opacity-hovering image-card-placeholder">
    </a>
    <div class="event-card-detail mx-2">
        <div class="flex mt-1 between">
            <a class="text-xl font-bold me-auto" href="detailEventUrl">{{ $item->title }}</a>
            <p class="text-lg font-bold">Online</p>
        </div>
        <div class="mt-1">
            <p class="text-lg text-gray-500">{{  date('d M y', strtotime($item->start_date)); }}</p>
            <p class="mt-3 font-bold text-lg">
                {{ $item->ticket_price == null ? 'Gratis' : 'Rp. '.number_format($item->ticket_price, 2, ',', '.') }}</p>
        </div>
        <div class="event-organizer flex items-center gap-3 mt-1 py-2 border-t-2 border-gray-500">
            <img src="" alt="" class="rounded-full image-profile-user-placeholder">
            <p class="text-lg">{{ $item->eventCreator->name }}</p>
        </div>
    </div>
</div>
