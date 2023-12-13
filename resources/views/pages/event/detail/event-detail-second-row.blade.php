<div class="block xl:flex gap-3 mt-3">
    <div class="w-full max-h-[374px] max-w-[811px] xl:min-h-[200px] xl:min-w-[811px] rounded-lg">
        <p class="text-2xl md:text-4xl font-bold mb-5">Deskripsi</p>
        <p class="text-md lg:text-lg">{{ $event->description }}</p>
    </div>
    <div class="w-full max-w-[811px] mt-3 xl:mt-0 block sm:flex">
        <p class="text-xl lg:text-2xl font-bold me-auto">
            {{ $event->ticket_price == null ? 'Gratis' : 'Rp. ' . number_format($event->ticket_price, 2, ',', '.') }}
        </p>
        <div class="mt-3 sm:mt-0">
            <a href="#daftarEvent"
                class="py-2 px-5 border-2 border-black rounded text-lg xl:text-xl text-gray-200 bg-gray-800">Daftar
                Event</a>
        </div>
    </div>
</div>
