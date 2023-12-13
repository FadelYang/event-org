<x-slot name="header">
    <h2 class="font-semibold text-lg lg:text-4xl leading-tight">
        {{ $event->title }}
    </h2>
    <div class="opacity-80 block lg:flex lg:gap-3">
        <div class="flex items-center gap-1">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z">
                </path>
            </svg>
            <p>{{ date('D, d M y', strtotime($event->start_date)) }}</p>
        </div>
        <p class="hidden lg:block"> - </p>
        <div class="flex items-center gap-1">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
            </svg>
            <p>{{ $event->location }}</p>
        </div>
    </div>
    <div class="mt-10">
        <ol class="flex flex-wrap gap-2 text-md lg:text-lg">
            @foreach (Breadcrumbs::generate('detailEvent', [$event->type, $event->slug]) as $breadcrumb)
                @if (!is_null($breadcrumb->url) && !$loop->last)
                    <li class="opacity-70 hover:opacity-100"><a
                            href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    <li>></li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
        </ol>
    </div>
</x-slot>