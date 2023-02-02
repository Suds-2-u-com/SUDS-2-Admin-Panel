@if(!empty($data))
<form action="{{url('update-On-Site-Request/'.$data->id)}}" method="post">
	@csrf
	{{-- <div class="form-group">
		<label for="text">First Name:</label>
		<select class="form-control" id="country_id" name="country_id" required="" >
			<option value="">Select Country</option>
			@if(count($country)>0)
			@foreach($country as $rows)
			<option value="{{$rows->id}}" @if($state->country_id==$rows->id) {{'selected'}} @endif>{{$rows->name}}</option>
			@endforeach
			@endif
		</select>
	</div> --}}
	<input type="hidden" name="id" value="{{ $data->id }}">
	<div class="form-group">
		<label for="text">First Name:</label>
		<input type="text" class="form-control"  name="first_name" required="" value="{{$data->first_name}}">
	</div>
	<div class="form-group">
		<label for="text">Last Name:</label>
		<input type="text" class="form-control"  name="last_name" required="" value="{{$data->last_name}}">
	</div>
	<div class="form-group">
		<label for="text">Email:</label>
		<input type="text" class="form-control" name="email" required="" value="{{$data->email}}">
	</div>
	<div class="form-group">
		<label for="text">Phone:</label>
		<input type="text" class="form-control" name="phone_number" required="" value="{{$data->phone_number}}">
	</div>
	<div class="form-group">
		<label for="text">State:</label>
		<select class="form-control" id="state" name="state_id" required="" >
			<option value="">Select State</option>
			@if(count($state) > 0)
			@foreach($state as $rows)
			<option value="{{$rows->id}}" @if($data->state == $rows->id) {{ 'selected' }} @endif>{{$rows->name}}</option>
			@endforeach
			@endif
		</select>
	</div>
	<div class="form-group">
		<label for="text">City:</label>
		<select class="form-control" id="city" name="city_id" required="" >
			<option value="">Select City</option>
			@if(count($city) > 0)
			@foreach($city as $rows)
			<option value="{{$rows->id}}" @if($data->city == $rows->id) selected @endif>{{$rows->name}}</option>
			@endforeach
			@endif
		</select>	
	</div>
	<div class="form-group">
		<label for="text">Zip code:</label>
		<input type="text" class="form-control"  name="zip_code" required="" value="{{$data->zip_code}}">
	</div>
	<div class="form-group">
		<label for="text">Address:</label>
		<input type="text" class="form-control"  name="address" required="" value="{{$data->address}}">
	</div>
	<div class="form-group">
		<label for="text">Payment type:</label>
		<select name="payment_method" class="form-control">
			<option value="">Payment Method</option>
			<option value="CC_Payment" @if($data->payment_method == "CC_Payment") selected @endif>CC Payment</option>
			<option value="PayPal" @if($data->payment_method == "PayPal") selected @endif>PayPal</option>
			<option value="Fleet_Card" @if($data->payment_method == "Fleet_Card") selected @endif>Fleet Card</option>
		</select>
	</div>
	<div class="form-group">
		<label for="text">Wash Type:</label>
		<select name="type_of_wash" id="type_of_wash" class="form-control" >

			<option value="">Select Wash Type</option>
			@if(!empty($category))
			@foreach($category as $typerow)
			<option value="{{$typerow->category_id}}" @if($data->type_of_wash == $typerow->category_id) selected @endif>{{$typerow->category_name}}</option>
			@endforeach
			@endif    
		</select>
	</div>

	<div class="form-group">
		<label for="text">Howmany vehicles:</label>
		<select name="how_many" id="how_many" class="form-control">
            <option value="">How Many Vehicles</option>
            <option value="1" @if($data->how_many == 1) selected @endif>1</option>
            <option value="2"  @if($data->how_many == 2) selected @endif>2</option>
            <option value="3"  @if($data->how_many == 3) selected @endif>3</option>
            <option value="4"  @if($data->how_many == 4) selected @endif>4</option>
        </select>
	</div>
	<div class="form-group">
		<label for="text">Property type:</label>
		<select class="form-control" name="property_type" >
			<option selected disabled value="">Property Type</option>
			<option value="Residential" @if($data->property_type == "Residential") selected @endif>Residential</option>
			<option value="Commercial" @if($data->property_type == "Commercial") selected @endif>Commercial</option>
		</select>
	</div>
	<div class="modal-footer">
		<button class="btn ripple btn-info" type="submit">Submit</button>
		<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
	</div>
</form>
@endif
