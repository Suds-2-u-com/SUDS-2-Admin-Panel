@if(!empty($transactions))
@foreach($transactions as $rows)
<table class="table mg-b-0 text-md-nowrap border">
	{{userBankdetails($rows['to_id'])}}
	
      <tr>
		<th>Amount</th>
		<td>${{number_format(($rows->amount/100),2,'.', '')}}</td>
	</tr>

	<tr>
		<th>SUDS-2-U Commission</th>
		<td>{{$rows->admin_comission}}%</td>
	</tr>
		<tr>
		<th>Washer Commission</th>
		<td>{{$rows->commmison}}%</td>
	</tr>
	 <tr>
		<th>Pay Amount</th>
		<td>${{number_format(($rows->washer_amt/100),2,'.', '')}}</td>
	</tr>
	<tr>
		<th>Transfer Id</th>
		<td>{{$rows->transfer_id}}</td>
	</tr>
	<tr>
		<th>Payment Status</th>
		<td>
			@if(/*$rows['status']*/$rows['payout_status']==0) 
		Pending
		@else
		Success
		@endif	
	</td>
	</tr>
</table>
<div class="modal-footer" >
	@if(/*$rows['status']*/$rows['payout_status']==0)
	<form action="{{url('payamount/'.$rows['id'])}}" method="post">
		@csrf
	<button class="btn ripple btn-danger"  type="submit" data-status="1" >Pay</button>
</form>
	@else
		
	@endif					
	<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
</div>

@endforeach
@endif