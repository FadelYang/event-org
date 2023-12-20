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
                    @foreach ($paymentHistories as $item)
                        {{ $item->id }}
                        {{ $item->customer_name }}
                        {{ $item->ticket_id }}
                        {{ $item->total_price }}
                        {{ $item->status }}
                        <a href="/">Invoice</a>
                        <br>
                    @endforeach
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-1">
                <div class="p-6 text-gray-900 text-xl font-bold">
                    Your Event
                </div>
                {{-- table --}}
                <div class="p-6">
                    You have no event
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
