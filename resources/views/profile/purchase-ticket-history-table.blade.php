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
                        <td><span class="px-2 py-1 leading-tight text-sm font-semibold text-green-700 bg-green-100 rounded-full">{{ $item->status }}</span></td>
                        <td>{{ date('D, d M y', strtotime($item->created_at)) }}</td>
                        <td><a href="#" class="px-2 py-1 leading-tight text-sm font-semibold bg-violet-100 text-violet-500 rounded-full">Detail Invoice</a>
                        </td>
                    @elseif ($item->status == 'pending')
                        <td><span class="px-2 py-1 leading-tight text-sm font-semibold text-orange-700 bg-orange-100 rounded-full">{{ $item->status }}</span></td>
                        <td>{{ date('D, d M y', strtotime($item->created_at)) }}</td>
                        <td><a href="#" class="px-2 py-1 leading-tight text-sm font-semibold bg-orange-100 text-orange-500 rounded-full">not found</a></td>
                    @else
                        <td><span class="px-2 py-1 leading-tight text-sm font-semibold  text-red-700 bg-red-100 rounded-full">{{ $item->status }}</span></td>
                        <td>{{ date('D, d M y', strtotime($item->created_at)) }}</td>
                        <td><a href="#" class="px-2 py-1 leading-tight text-sm font-semibold bg-violet-100 text-violet-500 rounded-full">Detail Invoice</a>
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
