<x-slot name="header">
    <div class="mt-10">
        <ol class="flex flex-wrap gap-2 text-md lg:text-lg">
            @foreach (Breadcrumbs::generate('checkoutTicket', [$event->type, $event->slug]) as $breadcrumb)
                @if (!is_null($breadcrumb->url) && !$loop->last)
                    <li class="opacity-70 hover:opacity-100"><a
                            href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    <li>></li>
                @else
                    <li class="breadcrumb-item">{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
        </ol>
    </div>
</x-slot>