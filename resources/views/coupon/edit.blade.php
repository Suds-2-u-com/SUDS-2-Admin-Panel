@if(!empty($coupon))
<form action="{{url('update-coupon/'.$coupon->id)}}" method="post">
    @csrf
    <div class="form-group">
        <label for="text">User :</label>
        <select class="form-control" id="user_id" name="user_id">
            <option value="">Select User</option>
            @if(!empty($user))
            @foreach($user as $rows)
            <option value="{{$rows->id}}" @if($coupon->user_id==$rows->id) {{'selected'}} @endif>{{$rows->name}}</option>
            @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <label for="text">Coupon Code:</label>
        <input type="text" class="form-control" id="coupan_code" name="coupan_code" required=""
            value="{{$coupon->coupan_code}}">
    </div>

    <div class="form-group">
        <label for="text">Amount:</label>
        <input type="text" class="form-control" id="amount" name="amount" required="" value="{{$coupon->amount}}">
    </div>
    <div class="form-group">
        <label for="text">Coupon Start Date:</label>
        <input type="date" class="form-control couponDate" id="start_date" name="start_date" required=""
            placeholder="Enter Start Date" value="{{$coupon->start_date}}">
    </div>
    <div class="form-group">
        <label for="text">Coupon End Date:</label>
        <input type="date" class="form-control couponDate" id="end_date" name="end_date" required=""
            placeholder="Enter End Date" value="{{$coupon->end_date}}">
    </div>
    <button class="btn ripple btn-info" type="submit">Submit</button>
</form>
@endif