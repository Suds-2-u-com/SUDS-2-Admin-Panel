<div class="table-responsive">
<table class="table mg-b-0 text-md-nowrap border">

	     <tr>
	         <th>Name</th>
	         <th>Account Number</th>
	         <th>Rounting Number</th>
	         <th>Bank Code</th>
	         <th>Branch Code</th>
	         <th>Amount</th>
	         <th>Pay Amount</th>
	         <th>Payment Status</th>
	         <th>Action</th>
	     </tr>
	     @if(!empty($transactions))
         @foreach($transactions as $rows)
         @php $user=userBankdetailsWasher($rows['to_id']);  @endphp
	     <tr>
	         <td>@if(!empty($user)) {{$user->bank_name}} @endif</td>
	         <td>@if(!empty($user)) {{$user->account_number}} @endif</td>
	         <td>@if(!empty($user)) {{$user->routing_number}} @endif</td>
	         <td>@if(!empty($user)) {{$user->bank_code}} @endif</td>
	         <td>@if(!empty($user)) {{$user->branch_code}} @endif</td>
	         <td>{{$rows->amount}}</td>
	         <td>{{$rows->washer_amt}}</td>
	         @if($rows['status']==0) 
	         <td>Pending</td>
	         @else
    		 <td>Success</td>
    		 @endif
    		 <td>
    		 @if($rows['status']==0)
    		 <button class="btn ripple btn-danger payment"  type="button" data-id="{{$rows['id']}}" >Pay</button>
    		 @else
    		 <button class="btn ripple btn-danger"  type="button"  >Paid</button>
    		 @endif
    		 </td>
	     </tr>
	     @endforeach
         @endif
	 </table>
	 </div>
	 
	 
      


