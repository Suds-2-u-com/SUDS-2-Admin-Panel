<table  class="table mg-b-0 text-md-nowrap border">
  
	@if(!empty($pressrequest))
	<tr>
		<th>Name</th>
		<td>{{$pressrequest[0]->fname.' '.$pressrequest[0]->	lname}}</td>
	</tr>

    <tr>
		<th>Email</th>
		<td>{{$pressrequest[0]->email}}</td>
	</tr>
	<tr>
		<th>Phone Number</th>
		<td>{{$pressrequest[0]->phone}}</td>
	</tr>
	<tr>
		<th>Service</th>
		<td>{{categoryname($pressrequest[0]->service)}}</td>
	</tr>
		<tr>
		<th>State</th>
		<td>{{state($pressrequest[0]->state)}}</td>
	</tr>
		<tr>
		<th>City</th>
		<td>{{city($pressrequest[0]->city)}}</td>
	</tr>
		<tr>
		<th>Zip Code</th>
		<td>{{$pressrequest[0]->zip_code}}</td>
	</tr>
		<tr>
		<th>Address</th>
		<td>{{$pressrequest[0]->address}}</td>
	</tr>
		<tr>
		<th>Payment Method</th>
		<td>{{$pressrequest[0]->payment_method}}</td>
	</tr>
		<tr>
		<th>How Many Washes</th>
		<td>{{$pressrequest[0]->how_many}}</td>
	</tr>
		<tr>
		<th>Property Type</th>
		<td>{{$pressrequest[0]->property_type}}</td>
	</tr>
		<tr>
		<th>Date</th>
		<td>{{$pressrequest[0]->created_at}}</td>
	</tr>
		<tr>
		<th>Status</th>
		<td>@if($pressrequest[0]->status=='0') {{'Pending'}} @else {{'Accepted'}} @endif </td>
	</tr>
	@endif
</table>