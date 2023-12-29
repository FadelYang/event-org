<x-app-layout>
    <div class="mt-3 max-w-7xl mx-1 lg:px-8 xl:mx-auto h-auto">
        <p class="font-bold text-4xl mb-5">
            Your payment are pending
        </p>
        <div class="p-5 bg-gray-300 rounded-lg mb-2">
            <p>order id: <span class="font-bold">{{ $orderId }}</span></p>
            <p>status: <span class="font-bold">{{ $payment->status }}</span></p>
            <p>Price Total: <span class="font-bold">{{ $totalPrice }}</span></p>
            <button class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800 mt-4"
                id="pay-button">finish payment</button>
        </div>
        <p class="font-bold text-2xl mb-2">
            Detail Customer
        </p>
        <div class="p-5 bg-gray-300 rounded-lg mb-2">
           @foreach ($detailCustomerData as $customerData)
               <p>Name: <span class="font-bold">{{ $customerData['customerName'] }}</span></p>
               <p>NIK: <span class="font-bold">{{ $customerData['customerNIK'] }}</span></p>
               <p>Email: <span class="font-bold">{{ $customerData['customerEmail'] }}</span></p>
               <p>Phone: <span class="font-bold">{{ $customerData['customerPhone'] }}</span></p>
               <p>Address: <span class="font-bold">{{ $customerData['customerAddress'] }}</span></p>
           @endforeach
        </div>
        <p class="font-bold text-2xl mb-2">
            Detail Tickets
        </p>
        @foreach ($allSelectedTickets as $SelectedTicket)
            <div class="items-center justify-center px-5 py-2 lg:p-5 rounded-xl bg-gray-200 mb-2">
                <p>type: <span class="font-bold">{{ $SelectedTicket['ticketName'] }}</span></p>
                <p>price: <span
                        class="font-bold">{{ $SelectedTicket['ticketPrice'] == null ? 'Gratis' : 'Rp. ' . number_format($SelectedTicket['ticketPrice'], 2, ',', '.') }}</span>
                </p>
                <p>Total: <span class="font-bold">{{ $SelectedTicket['totalSelectedTickets'] }}</span></p>
                <p>Date: <span class="font-bold">{{ date('D, d M y', strtotime($SelectedTicket['ticketDate'])) }}</span>
                </p>
            </div>
        @endforeach
    </div>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            console.log('{{ $snapToken }}')
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    // window.location.href = "{{ route('event.ticket.checkout-success') }}"
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
</x-app-layout>
