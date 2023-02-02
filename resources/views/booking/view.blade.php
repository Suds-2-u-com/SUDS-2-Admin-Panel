<table  class="table mg-b-0 text-md-nowrap border">
	@if(!empty($booking))
	<tr>
		<th>Wash Location</th>
		<td>{{$booking->wash_location}}</td>
	</tr>
	<tr>
		<th>{{vehicleName($booking->vehicle_id)}}</th>
		<th>$20</th>
	</tr>
	@php $extra_addons=explode(',',$booking->extra_add_ons); @endphp
	@if(count($extra_addons)>0)
	@foreach($extra_addons as $rows)
	@php $package=\App\PackageModel::where('package_id',$rows)->get();@endphp
	@if(count($package)>0)
	@foreach($package as $rowsPackage)
	
	<tr>
		<th>{{$rowsPackage->package_name}}</th>
		<td>${{$rowsPackage->package_price}}</td>
	</tr>
	@endforeach
	@endif
	@endforeach
    @endif
    <tr>
		<th>Distance Fee</th>
		<td>$12</td>
	</tr>
	<tr>
		<th>Extra Minutes</th>
		<td>$10</td>
	</tr>
	<tr>
		<th>Total</th>
		<td>$200</td>
	</tr>
	@endif
</table>