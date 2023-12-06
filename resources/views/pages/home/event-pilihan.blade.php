<div id="eventPilihan">
    <div class="section-header my-10 block md:flex items-center">
        <p class="text-2xl font-extrabold md:text-4xl me-auto">Event Pilihan</p>
    </div>

    <div class="">
        <div class="section-content flex flex-nowrap gap-3 overflow-x-scroll snap-x snap-mandatory no-scrollbar">
            @for ($i = 0; $i < 10; $i++)
                @include('components.event-card')
            @endfor
        </div>
    </div>
</div>
