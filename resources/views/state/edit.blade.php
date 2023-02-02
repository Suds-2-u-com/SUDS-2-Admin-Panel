@if(!empty($state))
<form action="{{url('update-state/'.$state->id)}}" method="post">
								 @csrf
						
								
								  <div class="form-group">
								    <label for="text">Country Name:</label>
								    <select class="form-control" id="country_id" name="country_id" required="" >
								    	<option value="">Select Country</option>
								    	@if(count($country)>0)
								    	@foreach($country as $rows)
								    	<option value="{{$rows->id}}" @if($state->country_id==$rows->id) {{'selected'}} @endif>{{$rows->name}}</option>
								    	@endforeach
								    	@endif
								    </select>
								  </div>

								  <div class="form-group">
								    <label for="text">State Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" value="{{$state->name}}">
								  </div>
								 
							
							<div class="modal-footer">
								<button class="btn ripple btn-info" type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						  </form>
						  @endif