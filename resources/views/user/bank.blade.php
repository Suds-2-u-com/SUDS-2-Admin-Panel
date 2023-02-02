@if(!empty($bank))
<table class="table mg-b-0 text-md-nowrap border">
	
	<tr>
		<th>Name</th>
		<td>{{$bank->bank_name}}</td>
	</tr>
	<tr>
		<th>Account Number</th>
		<td>{{$bank->account_number}}</td>
	</tr>
	<tr>
		<th>Rounting Number</th>
		<td>{{$bank->routing_number}}</td>
	</tr>
	<tr>
		<th>Bank Code</th>
		<td>{{$bank->bank_code}}</td>
	</tr>
	
	<tr>
		<th>Branch Code</th>
		<td>{{$bank->branch_code}}</td>
	</tr>
	<tr>
		<th>Created At</th>
		<td>{{$bank->created_at}}</td>
	</tr>
	<tr>
		<th>Updated At</th>
		<td>{{$bank->updated_at}}</td>
	</tr>

</table>
@else
<p>Bank Details Not Available</p>
@endif