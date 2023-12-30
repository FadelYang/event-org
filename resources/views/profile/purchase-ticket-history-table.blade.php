@if (count($paymentHistories) != 0)
    <table id="paymentHistoryTable" class="display">
        <thead class="">
            <tr>
                <th class="hidden">Id</th>
                <th>Order ID</th>
                <th>Event Name</th>
                <th>Total Ticket Price</th>
                <th>Status</th>
                <th>Checkout Date</th>
                <th>invoice</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentHistories as $item)
                <tr>
                    <td class="hidden">{{ $item->id }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td>{{ $item->event_name }}</td>
                    <td>{{ $item->total_price }}</td>
                    @if ($item->status == 'success')
                        <td><span class="p-1 text-sm bg-green-500 rounded-xl border-2 border-g">{{ $item->status }}</span></td>
                        <td>{{ date('D, d M y', strtotime($item->created_at)) }}</td>
                        <td><a href="#" class="p-1 text-sm bg-violet-500 rounded-xl border-2 border-g">Detail Invoice</a>
                        </td>
                    @elseif ($item->status == 'pending')
                        <td><span class="p-1 text-sm bg-yellow-500 rounded-xl border-2 border-g">{{ $item->status }}</span></td>
                        <td>{{ date('D, d M y', strtotime($item->created_at)) }}</td>
                        <td><a href="#" class="p-1 text-sm bg-orange-500 rounded-xl border-2 border-g">not found</a></td>
                    @else
                        <td><span class="p-1 text-sm bg-red-500 rounded-xl border-2 border-g">{{ $item->status }}</span></td>
                        <td>{{ date('D, d M y', strtotime($item->created_at)) }}</td>
                        <td><a href="#" class="p-1 text-sm bg-violet-500 rounded-xl border-2 border-g">Detail Invoice</a>
                        </td>
                    @endif
                    {{-- must have updated_at column in database --}}

                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="mt-6">You don't have any purchase history</p>
@endif
