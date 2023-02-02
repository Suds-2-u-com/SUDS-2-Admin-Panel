<div class="table-responsive">
<table class="table mg-b-0 text-md-nowrap border">

	     <tr>
	         <th>Account Id</th>
	         <th>Account Link</th>
	     </tr>
	     @if($transactions)
	     <tr>
	         <td>{{$transactions->washer_accountid}}</td>
	         <td>{{$transactions->washer_account_link}}</td>
	     </tr>
         @endif
	 </table>
<div class="modal-footer" >
{{-- @if($transactions && ($transactions->washer_accountid == '' || $transactions->washer_account_link == '')) --}}

<form action="{{url('createAccount/'.$transactions->id)}}" method="post">
@csrf
<button class="btn ripple btn-danger"  type="submit" data-status="1" >Account Create</button>
</form>

{{-- @endif	 --}}				
<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
</div>
	 </div>
	 
	 
      


