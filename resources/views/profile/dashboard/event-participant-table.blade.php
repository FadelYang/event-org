@if (count($eventParticipants) != 0)
    <table id="eventParticipantTable" class="display w-full">
        <thead class="">
            <tr class="w-full">
                <th class="hidden">Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Total Ticket</th>
                <th>Total Ticket Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventParticipants as $eventParticipant)
                <tr class="">
                    <td class="hidden">{{ $eventParticipant->id }}</td>
                    <td>{{ $eventParticipant->ticketOwner->name }}</td>
                    <td>{{ $eventParticipant->ticketOwner->email }}</td>
                    <td>{{ json_decode($eventParticipant->item_detail)[0]->totalSelectedTickets }}</td>
                    <td>{{ $eventParticipant->total_price }}</td>
                    @if ($eventParticipant->status == 'success')
                        <td><span
                                class="px-2 py-1 leading-tight text-sm font-semibold text-green-700 bg-green-100 rounded-full">{{ $eventParticipant->status }}</span>
                        </td>
                    @elseif ($eventParticipant->status == 'pending')
                        <td><span
                                class="px-2 py-1 leading-tight text-sm font-semibold text-orange-700 bg-orange-100 rounded-full">{{ $eventParticipant->status }}</span>
                        </td>
                    @else
                        <td><span
                                class="px-2 py-1 leading-tight text-sm font-semibold  text-red-700 bg-red-100 rounded-full">{{ $eventParticipant->status }}</span>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="mt-6">You don't have any participant</p>
@endif
