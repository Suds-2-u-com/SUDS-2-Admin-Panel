                       @if(count($vehicle)>0)
                       @foreach($vehicle as $vehicleRow)

                       <table class="table mg-b-0 text-md-nowrap border">
                       	<tr>
                       		<th>Make</th>
                       		<td>{{ucfirst($vehicleRow['make'])}}</td>
                       	</tr>
                       	<tr>
                       		<th>Year</th>
                       		<td>{{ucfirst($vehicleRow['year'])}}</td>
                       	</tr>
                       	<tr>
                       		<th>Model</th>
                       		<td>{{ucfirst($vehicleRow['model'])}}</td>
                       	</tr>
                       	<tr>
                       		<th>Engine</th>
                       		<td>{{ucfirst($vehicleRow['engine'])}}</td>
                       	</tr>
                       	<tr>
                       		<th>Created Date</th>
                       		<td>{{ucfirst($vehicleRow['created_at'])}}</td>
                       	</tr>
                       		<tr>
                       		<th>Vehicle Image</th>
                       		<td><img class="avatar brround avatar-md  mr-3" src="{{url('public/vehicle/'.$vehicleRow['image'])}}" alt="img"></td>
                       	</tr>
                       </table>
                                   
						@endforeach	
						@else
						<p>Not available</p>
						@endif