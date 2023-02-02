@if(!empty($vehicle))
<table class="table text-md-nowrap">
    <tr>
        <th>Name</th>
        <td>{{$vehicle->name}}</td>
    </tr>
    <tr>
        <th>issued_state</th>
        <td>{{$vehicle->issued_state}}</td>
    </tr>
    <tr>
        <th>Exp Date</th>
        <td>{{$vehicle->exp_date}}</td>
    </tr>
    <tr>
        <th>Image</th>
        <td><img src="{{url('public/vehicle/'.$vehicle->image)}}" width="50px" height="50px"></td>
    </tr>
    <tr>
        <th>User Name</th>
        <td>{{userName($vehicle->user_id)}}</td>
    </tr>
</table>
<div class="modal-footer">
    @if($vehicle->status == 1)
    <button class="btn ripple btn-danger changeVehicleRegStatus" type="button" data-id="{{$vehicle->id}}"
        data-status="0">Disapproved</button>
    @else
    <button class="btn ripple btn-success changeVehicleRegStatus" type="button" data-id="{{$vehicle->id}}"
        data-status="1">Approved</button>
    @endif
    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
</div>
@else
<p>Data not found</p>
@endif