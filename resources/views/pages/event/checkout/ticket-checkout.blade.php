<x-app-layout>
    @include('pages.event.checkout.header')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="mb-2">
            <p class="text-2xl font-bold">Detail selected tickets</p>
        </div>
        @foreach ($allSelectedTickets as $SelectedTicket)
            <div class="items-center justify-center px-5 py-2 lg:p-5 rounded-xl bg-gray-200 mb-2">
                <p>type: <span class="font-bold">{{ $SelectedTicket['ticketName'] }}</span></p>
                <p>price: <span class="font-bold">{{ $SelectedTicket['ticketPrice'] == null ? 'Gratis' : 'Rp. ' . number_format($SelectedTicket['ticketPrice'], 2, ',', '.') }}</span></p>
                <p>Total: <span class="font-bold">{{ $SelectedTicket['totalSelectedTickets'] }}</span></p>
                <p>Date: <span class="font-bold">{{ date('D, d M y', strtotime($SelectedTicket['ticketDate'])) }}</span></p>
            </div>
        @endforeach
        <div>
            <p class="text-lg">Total price: <span class="font-bold">{{ 'Rp. ' . number_format($totalPrice, 2, ',', '.') }}</span></p>
        </div>

        <div class="mt-5">
            <div>
                <p class="text-2xl font-bold">Detail Order Data</p>
            </div>
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
                    <input type="text" value="{{ $orderId }}" name="order_id">
                </div>
                <button type="submit"
                    class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800 mt-4">Checkout</button>
            </form>
        </div>
    </div>


</x-app-layout>
