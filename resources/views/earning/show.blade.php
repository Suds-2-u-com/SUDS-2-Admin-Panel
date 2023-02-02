@if(!empty($bookings))
<table class="table mg-b-0 text-md-nowrap border">
    <thead>
        <tr>
            <th class="wd-15p border-bottom-0">S.No</th>
            <th class="wd-15p border-bottom-0">Booking Date</th>
            <th class="wd-15p border-bottom-0">Total Count</th>
            <th class="wd-15p border-bottom-0">Total Amount</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($bookings) && count($bookings) > 0)
        @php $i=0; @endphp
        @foreach($bookings as $rows)
        @php $i++ @endphp
        <tr>
            <td>{{$i}}</td>
            <td>{{$rows->booking_date}}</td>
            <td>{{$rows->booking_count}}</td>
            <td>{{$rows->total_amt}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="4">No data found!</td>
        </tr>
        @endif
    </tbody>
</table>
@else
<p>Not available</p>              
@endif