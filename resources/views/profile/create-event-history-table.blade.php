@if (count($createEventHistories) != 0)
<table id="paymentHistoryTable" class="display w-full">
    <thead class="">
        <tr class="">
            <th class="hidden">Id</th>
            <th>Event Name</th>
            <th>Submit Date</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>status</th>
            <th>Is Publish</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($createEventHistories as $event)
            <tr class="">
                <td class="hidden">{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ date('D, d M y', strtotime($event->created_at)) }}</td>
                <td>{{ date('D, d M y', strtotime($event->start_date)) }}</td>
                <td>{{ date('D, d M y', strtotime($event->start_date . ' + ' . $event->total_day . ' days')) }}
                </td>
                @if ($event->status == App\Enum\EventCuratedStatusEnum::APPROVED->value)
                    <td><span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">Approved</span>
                    </td>
                @elseif($event->status == App\Enum\EventCuratedStatusEnum::PENDING->value)
                    <td>
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full">Pending</span>
                    </td>
                @else
                    <td><span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">Reject</span>
                    </td>
                @endif
                @if ($event->is_publish == 1)
                    <td><span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">publish</span>
                    </td>
                @else
                    <td><span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">Not
                            publish</span>
                    </td>
                @endif
                <td>
                    <div class="flex">
                        <div class="text-blue-500">
                            <a href="{{ route('user.event.detail', [Auth::user()->name, $event->type, $event->slug]) }}">
                                Detail Event
                            </a>
                        </div>
                    </div>
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p class="mt-6">You don't have any create event history</p>
@endif
