<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-white leading-tight">
            {{ $event->title }}
        </h2>
        <div class="text-gray-300 block lg:flex lg:gap-3">
            <p>
                {{ date('D, d M y', strtotime($event->start_date)) }}
            </p>
            <p class="hidden lg:block"> - </p>
            <p>
                {{ $event->location }}
            </p>
        </div>
        <div class="text-white mt-10">
            <ol class="flex gap-1">
                @foreach (Breadcrumbs::generate('detailEvent', [$event->type, $event->slug]) as $breadcrumb)
                    @if (!is_null($breadcrumb->url) && !$loop->last)
                        <li class="opacity-50 hover:opacity-100"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                        <li>/</li>
                    @else
                        <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                    @endif
                @endforeach
            </ol>
        </div>
    </x-slot>

    <div>
        {{ $event->id }}
        {{ $event->title }}
        {{ $event->description }}
    </div>
</x-app-layout>
