<x-slot name="header">
    <h2 class="font-semibold text-lg lg:text-4xl leading-tight">
        Create Event
    </h2>
    <h3 class="text-md lg:text-xl opacity-50">Buat dan promosikan event kamu di Evenin</h3>
    <div class="mt-10">
        <ol class="flex flex-wrap gap-2 text-md lg:text-lg">
            @foreach (Breadcrumbs::generate('createEvent') as $breadcrumb)
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