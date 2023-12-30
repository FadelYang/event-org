<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Welcome {{ Auth::user()->name }}
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-1">
                <div class="px-6 mt-6 text-gray-900 text-xl font-bold">
                    Your purchase history
                </div>
                {{-- table --}}
                <div class="px-6">
                    @include('profile.purchase-ticket-history-table')
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-1">
                <div class="p-6 text-gray-900 text-xl font-bold">
                    Your Event
                </div>
                <div class="p-6">
                    @if (count($createEventHistories) != 0)
                        @foreach ($createEventHistories as $item)
                            {{ $item->id }}
                            {{ $item->title }}
                            {{ $item->status }}
                            <br>
                        @endforeach
                    @else
                        <p class="mt-6">You don't have any create event history</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script>
            let table = new DataTable('#paymentHistoryTable', {
                "pageLength": 10,
                "dom": 'frtip',
                "order": [0, 'desc'],
                "initComplete": function(settings, json) {
                    $("#paymentHistoryTable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
                },
            });
        </script>
    @endpush
</x-app-layout>
