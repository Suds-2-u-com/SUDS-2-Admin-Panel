<div id="successmsg"></div>
<form action="#" id="payoutid" method="post">
    @csrf
    <input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">
    <input type="hidden" id="payment_id" name="payment_id" value="{{$id}}">
    @if(!empty($payment))
 
  <div class="form-group">
    <label for="email">Bank Account:</label>
    <input type="text" class="form-control" id="bank_account" value="{{$payment->bank_account}}" name="bank_account">
    <span class="text-danger error-text bank_account_err"></span>
  </div>
  <div class="form-group">
    <label for="pwd">Transaction Id:</label>
    <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="{{$payment->transaction_id}}">
        <span class="text-danger error-text transaction_id_err"></span>
  </div>
  <div class="form-group">
    <label for="pwd">Transaction Time:</label>
    <input type="time" class="form-control" id="transaction_time" name="transaction_time" value="{{$payment->transaction_time}}">
     <span class="text-danger error-text transaction_time_err"></span>
  </div>  
  <div class="form-group">
    <label for="pwd">Transaction Amount:</label>
    <input type="text" class="form-control" id="transaction_amount" name="transaction_amount" value="{{$payment->transaction_amount}}">
    <span class="text-danger error-text transaction_amount_err"></span>
  </div> 
  <div class="form-group">
    <label for="pwd">Transaction Date:</label>
    <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="{{$payment->transaction_date}}">
     <span class="text-danger error-text transaction_date_err"></span>
  </div> 
  @else
  <div class="form-group">
    <label for="email">Bank Account:</label>
    <input type="text" class="form-control" id="bank_account" value="@if(!empty($bank)) {{$bank->account_number}} @endif" name="bank_account">
    <span class="text-danger error-text bank_account_err"></span>
  </div>
  <div class="form-group">
    <label for="pwd">Transaction Id:</label>
    <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="">
        <span class="text-danger error-text transaction_id_err"></span>
  </div>
  <div class="form-group">
    <label for="pwd">Transaction Time:</label>
    <input type="time" class="form-control" id="transaction_time" name="transaction_time" value="">
     <span class="text-danger error-text transaction_time_err"></span>
  </div>  
  <div class="form-group">
    <label for="pwd">Transaction Amount:</label>
    <input type="text" class="form-control" id="transaction_amount" name="transaction_amount" value="">
    <span class="text-danger error-text transaction_amount_err"></span>
  </div> 
  <div class="form-group">
    <label for="pwd">Transaction Date:</label>
    <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="">
     <span class="text-danger error-text transaction_date_err"></span>
  </div>
  
  @endif
  @if(empty($payment))
  <button type="button" class="btn btn-info payoutbtn">Submit</button>
  @endif
</form>