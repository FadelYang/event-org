<div class="event-card bg-white max-w-sm md:max-w-xs rounded-xl min-w-max snap-center">
    {{-- {{dd()}} --}}
    <a href="{{ route('event.detail', [$item->type, $item->slug]) }}">
        <img src="{{ $item->potrait_banner ? asset('images/potraitBanner/' . $item->potrait_banner) : asset('images/potraitBanner/default-potrait-poster.jpg')  }}" alt=""
            class="w-full rounded-t-xl max-w-[324px] max-h-[405px] opacity-hovering image-card-placeholder object-cover">
    </a>
    <div class="event-card-detail mx-2">
        <div class="flex mt-1 between">
            <a class="text-xl font-bold me-auto max-w-[240px] overflow-hidden overflow-ellipsis whitespace-nowrap"
                href="detailEventUrl">{{ $item->title }}</a>
            <p class="text-lg font-bold">Online</p>
        </div>
        <div class="mt-1">
            <p class="text-lg text-gray-500">{{ date('D, d M y', strtotime($item->start_date)) }}</p>
            <p class="mt-3 font-bold text-lg">
                @if ($item->tickets->first() != null)
                {{ $item->tickets->first()->ticket_price == 0 ? 'Gratis' : 'Rp. ' . number_format($item->tickets->first()->ticket_price, 2, ',', '.') }}</p>
                @else
                <p class="mt-3 font-bold text-lg">Tidak ada info penjualan tiket</p>
                @endif
        </div>
        <div class="event-organizer flex items-center gap-3 mt-1 py-2 border-t-2 border-gray-500">
            <img src="" alt="" class="rounded-full image-profile-user-placeholder">
            <p class="text-lg max-w-[240px]">{{ $item->organizer_name }}</p>
        </div>
    </div>
</div>
