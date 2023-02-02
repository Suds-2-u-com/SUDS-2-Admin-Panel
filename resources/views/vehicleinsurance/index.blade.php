@if(!empty($vehicle))


<table class="table text-md-nowrap">

  <tr>
        <th>Name</th>
        <td>{{$vehicle->name}}</td>
    </tr>
    <tr>
        <th>Carriers Name</th>
        <td>{{$vehicle->carriers_name}}</td>
    </tr>
    
    
    
     <tr>
        <th>Policy Number</th>
        <td>{{$vehicle->policy_number}}</td>
    </tr>
    <tr>
        <th>Expiration date</th>
        <td>{{$vehicle->expiration_date}}</td>
    </tr>
    
     <tr>
        <th>Image</th>
        <td><img src="{{url('public/insurance/'.$vehicle->image)}}" width="50px"  height="50px"></td>
    </tr>
   
    <tr>
        <th>User Name</th>
        <td>{{userName($vehicle->user_id)}}</td>
    </tr>
    
    
</table>

<div class="modal-footer">
    @if($vehicle->status == 1)
    <button class="btn ripple btn-danger changeVehicleInsurStatus" type="button" data-id="{{$vehicle->id}}"
        data-status="0">Disapproved</button>
    @else
    <button class="btn ripple btn-success changeVehicleInsurStatus" type="button" data-id="{{$vehicle->id}}"
        data-status="1">Approved</button>
    @endif
    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
</div>

@else
<p>Data not found</p>
@endif