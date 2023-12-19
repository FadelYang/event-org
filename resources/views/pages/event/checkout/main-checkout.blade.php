<x-app-layout>
    <div class="mt-3 max-w-7xl mx-1 lg:px-8 xl:mx-auto h-auto">
        <p class="font-bold text-4xl mb-5">
            Your payment are pending
        </p>
        <div class="p-5 bg-gray-300 rounded-lg">
            <p>order id: {{ $payment->id }}</p>
            <p>order id: {{ $payment->status }}</p>
            <p>Name: {{ $payment->customer_name }}</p>
            <p>Email: {{ $payment->customer_email }}</p>
            <p>Phone: {{ $payment->customer_phone }}</p>
            <p>Customer address: {{ $payment->customer_address }}</p>
            <button class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800 mt-4"
                id="pay-button">finish payment</button>
        </div>
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
