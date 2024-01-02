@if (count($paymentHistories) != 0)
    <table id="paymentHistoryTable" class="display w-full">
        <thead class="">
            <tr>
                <th class="hidden">Id</th>
                <th class="w-[12%]">Order ID</th>
                <th>Event Name</th>
                <th class="w-[15%]">Total Ticket Price</th>
                <th class="w-[12%]">Status</th>
                <th class="w-[15%]">Checkout Date</th>
                <th class="w-[15%] lg-w-[12%]">invoice</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentHistories as $item)
                <tr>
                    <td class="hidden">{{ $item->id }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td>{{ $item->event_name }}</td>
                    <td>{{ 'Rp. ' . number_format($item->total_price, 2, ',', '.') }}</td>
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
                    <td><a href="#">action</a></td>

                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="mt-6">You don't have any purchase history</p>
@endif
