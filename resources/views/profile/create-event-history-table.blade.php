@if (count($createEventHistories) != 0)
    <table id="createEventHistoryTable" class="display w-full">
        <thead class="">
            <tr>
                <th class="hidden">Id</th>
                <th>Event Name</th>
                <th>Start Date</th>
                <th>Is Publish</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($createEventHistories as $item)
                <tr>
                    <td class="hidden">{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ date('D, d M y', strtotime($item->start_date)) }}</td>
                    @if ($item->is_publish == 1)
                        <td><span class="p-1 text-sm bg-green-500 rounded-xl border-2 border-g">publish</span>
                        </td>
                    @else
                        <td><span class="p-1 text-sm bg-red-500 rounded-xl border-2 border-g">Not publish</span>
                        </td>
                    @endif
                    <td><a href="#">action</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="mt-6">You don't have any create event history</p>
@endif
