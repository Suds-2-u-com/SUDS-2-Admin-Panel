@if(!empty($doc))
<table class="table mg-b-0 text-md-nowrap border">

    <tr>
        <th>License Number</th>
        <td>{{$doc->license_number}}</td>
    </tr>
    <tr>
        <th>License Classification</th>
        <td>{{$doc->license_classification}}</td>
    </tr>
    <tr>
        <th>Issued On</th>
        <td>{{$doc->issued_on}}</td>
    </tr>
    <tr>
        <th>Expiry Date</th>
        <td>{{$doc->expiry_date}}</td>
    </tr>
    <tr>
        <th>Created At</th>
        <td>{{$doc->created_at}}</td>
    </tr>
    <tr>
        <th>License Image</th>
        <td><img src="{{url('public/document/'.$doc->license_image)}}" height="50px" width="50px"></td>
    </tr>

</table>
<div class="modal-footer">
    @if($doc->status==0)
    <button class="btn ripple btn-danger chnagestatus" type="button" data-id="{{$doc->id}}"
        data-status="1">Disapproved</button>
    @else
    <button class="btn ripple btn-success chnagestatus" type="button" data-id="{{$doc->id}}"
        data-status="0">Approved</button>
    @endif
    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
</div>
@else
<p>Document Details Not Available</p>
@endif