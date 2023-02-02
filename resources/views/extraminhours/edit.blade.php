@if(!empty($extra))
<form action="{{url('update-minhours/'.$extra->id)}}" method="post">
								 @csrf
						
								  <div class="form-group">
								    <label for="text">Extra Min & Hours</label>
								    <select class="form-control" name="min_hours" id="	min_hours">
								    	<option value="">Select Extra Min & Hours</option>
								    	<option value="min" @if($extra->min_hours=='min') {{'selected'}} @endif>Min</option>
								    	<option value="hours" @if($extra->min_hours=='hours') {{'selected'}} @endif>Hours</option>
								    </select>
								  </div>	
								  <div class="form-group">
								    <label for="text">Extra time</label>
								    <input type="text" class="form-control" id="extra_time" name="extra_time" required="" value="{{$extra->extra_time}}">
								  </div>
								  <div class="form-group">
								    <label for="text">Price:</label>
								    <input type="text" class="form-control" id="price" name="price" required="" value="{{$extra->price}}">
								  </div> 

							<div class="modal-footer">
								<button class="btn ripple btn-info" type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						  </form>
						  @endif