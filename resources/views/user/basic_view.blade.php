












	@if(!empty($user))
<table class="table mg-b-0 text-md-nowrap border">

	<tr>
		<th>Name</th>
		<td>{{$user->name}}</td>
	</tr>
	<tr>
		<th>Email</th>
		<td>{{$user->email}}</td>
	</tr>
	<tr>
		<th>Mobile</th>
		<td>{{$user->mobile}}</td>
	</tr>
	
		<tr>
		<th>Image</th>
		@if(!empty($user->image))
		<td><img src="{{url('public/profile/'.$user->image)}}" width='50px' height="50px"></td>
		@else
		<td>No Image Available</td>
		@endif
	</tr>

</table>
@else
<p>Not available</p>
@endif