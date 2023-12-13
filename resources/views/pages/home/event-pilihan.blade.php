<div id="eventPilihan">
    <div class="section-header my-2 md:my-10 block md:flex items-center">
        <p class="text-2xl font-extrabold md:text-4xl me-auto">Event Pilihan</p>
        <div class="flex gap-3 md:gap-4 me-10 mt-1 md:mt-0">
            <button id="buttonLeftEventPilihan"
                class="h-8 w-8 md:h-10 md:w-10 bg-gray-600 text-white rounded-full font-bold text-xl md:text-3xl"><</button>
                    <button id="buttonRightEventPilihan"
                        class="h-8 w-8 md:h-10 md:w-10 bg-gray-600 text-white rounded-full font-bold text-xl md:text-3xl">></button>
        </div>
    </div>

    <div class="">
        <div id="eventPilihanContainer"
            class="event-pilihan-wrap flex flex-nowrap gap-3 overflow-x-scroll snap-x snap-mandatory no-scrollbar scroll-smooth">
            @foreach ($pilihanEvents as $item)
                @include('components.event-card')
            @endforeach
        </div>
    </div>
</div>

@push('javascript')
    <script>
        console.log("hello js");

        const buttonRightEventPilihan = document.getElementById('buttonRightEventPilihan')
        const buttonLeftEventPilihan = document.getElementById('buttonLeftEventPilihan')

        buttonRightEventPilihan.onclick = () => {
            console.log('you clicked right button');

            document.getElementById('eventPilihanContainer').scrollLeft += 200
        }

        buttonLeftEventPilihan.onclick = () => {
            console.log('you clicked left button');

            document.getElementById('eventPilihanContainer').scrollLeft -= 200
        }
    </script>
@endpush
