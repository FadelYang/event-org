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
                <div class="p-6 text-gray-900 text-xl font-bold">
                    Your purchase history
                </div>
                {{-- table --}}
                <div class="p-6">
                    @if (count($paymentHistories) != 0)
                        @foreach ($paymentHistories as $item)
                            {{ $item->id }}
                            {{ $item->customer_name }}
                            {{ $item->ticket_id }}
                            {{ $item->total_price }}
                            {{ $item->status }}
                            <a href="/">Invoice</a>
                            <br>
                        @endforeach
                    @else
                        <p class="mt-6">You don't have any purchase history</p>
                    @endif

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
</x-app-layout>
