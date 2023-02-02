@if(!empty($background))
<table class="table text-md-nowrap">
    <tr>
        <th>First name</th>
        <td>{{$background->first_name}}</td>
    </tr>
    <tr>
        <th>Middle Name</th>
        <td>{{$background->middle_name}}</td>
    </tr>
    <tr>
        <th>Last name</th>
        <td>{{$background->last_name}}</td>
    </tr>
    <tr>
        <th>Dob</th>
        <td>{{$background->dob}}</td>
    </tr>

    <tr>
        <th>Social Security Number</th>
        <td>{{$background->social_security_number}}</td>
    </tr>
    <tr>
        <th>Drivers License Number</th>
        <td>{{$background->drivers_license_number}}</td>
    </tr>

    <tr>
        <th>State Issuing License</th>
        <td>{{$background->state_issuing_license}}</td>
    </tr>
    <tr>
        <th>Present Street Address</th>
        <td>{{$background->present_street_address}}</td>
    </tr>

    <tr>
        <th>City state zip</th>
        <td>{{$background->city_state_zip}}</td>
    </tr>
    <tr>
        <th>User Name</th>
        <td>{{userName($background->user_id)}}</td>
    </tr>
</table>
<div class="modal-footer">
    @if($background->status == 1)
    <button class="btn ripple btn-danger chnageBackgroupStatus" type="button" data-id="{{$background->id}}"
        data-status="0">Disapproved</button>
    @else
    <button class="btn ripple btn-success chnageBackgroupStatus" type="button" data-id="{{$background->id}}"
        data-status="1">Approved</button>
    @endif
    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
</div>
@else
<p>Data not found</p>
@endif