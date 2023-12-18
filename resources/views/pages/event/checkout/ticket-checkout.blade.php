<x-app-layout>
    @include('pages.event.checkout.header')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="items-center justify-center px-5 py-10 lg:p-5 hero-banner rounded-xl">
            @foreach ($eventDetails as $item)
                <p>{{ $item }}</p>
            @endforeach
            @foreach ($ticketCheckoutDetails as $item)
                <p>{{ $item['ticket_quantity'] }}</p>
                <p>{{ $item['event_date'] }}</p>
            @endforeach
            <p>Total ticket quantity: {{ $totalTicket }}</p>
            <p>Total ticket price : {{ 'Rp. ' . number_format($totalPrice, 2, ',', '.') }}</p>

        </div>
        <div class="mt-5">
            <form action="{{ route('ticket.checkout-handle', $orderId) }}" method="post">
                @csrf
                <div>
                    <x-input-label for="customer_name" :value="__('Name')" />
                    <x-text-input id="customer_name" class="block mt-1 w-full" type="text" name="customer_name"
                        :value="old('customer_name')" required autofocus autocomplete="username" />
                    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                </div>
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="customer_email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="customer_phone" :value="__('Phone number')" />
                    <x-text-input id="customer_phone" class="block mt-1 w-full" type="text" name="customer_phone"
                        :value="old('customer_phone')" required autofocus autocomplete="customer_phone" placeholder="+628xxx" />
                    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                </div>
                <div>
                    <x-input-label for="customer_address" :value="__('Address')" />
                    <textarea id="customer_address"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        type="text" name="customer_address" :value="old('customer_address')" required autofocus
                        autocomplete="customer_address"></textarea>
                    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                </div>
                <div>
                    <x-input-label for="customer_NIK" :value="__('NIK')" />
                    <x-text-input id="customer_NIK" class="block mt-1 w-full" type="text" name="customer_NIK"
                        :value="old('customer_NIK')" required autofocus autocomplete="customer_NIK" />
                    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                </div>
                <div class="hidden">
                    <input type="text" value="{{ $totalPrice }}" name="total_price">
                    <input type="text" value="{{ $ticketId }}" name="ticket_id">
                </div>
                <button type="submit"
                    class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800 mt-4">Checkout</button>
            </form>
        </div>
    </div>


</x-app-layout>
