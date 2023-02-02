@if(!empty($city))
<form action="{{url('update-city/'.$city->id)}}" method="post">
								 @csrf
							
								
								   <div class="form-group">
								    <label for="text">State Name:</label>
								    <select class="form-control" id="state_id" name="state_id" required="" >
								    	<option value="">Select State</option>
								    	@if(count($state)>0)
								    	@foreach($state as $rows)
								    	<option value="{{$rows->id}}" @if($rows->id==$city->state_id) {{'selected'}} @endif>{{$rows->name}}</option>
								    	@endforeach
								    	@endif
								    </select>
								  </div>

								  <div class="form-group">
								    <label for="text">City Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" value="{{$city->name}}" placeholder="Please enter city">
								  </div>
							
							<div class="modal-footer">
								<button class="btn ripple btn-info" type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						  </form>
						  @endif