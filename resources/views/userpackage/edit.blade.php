
			@if(!empty($package))
			<form action="{{url('edit-user-package-frm/'.$package->id)}}" method="post">
								 @csrf
								  <div class="form-group">
								    <label for="text">Washer :</label>
								    <select class="form-control" id="user_id" name="user_id" required="" >
								    	<option value="">Select Washer</option>
								    	@if(!empty($user))
								    	@foreach($user as $rows)
								    	 <option value="{{$rows->id}}" @if($package->user_id==$rows->id) {{'selected'}} @endif>{{$rows->name}}</option>
								    	@endforeach
								    	@endif
								    </select>
								  </div>
								

								  <div class="form-group">
								    <label for="text">Package Price:</label>
								    <input type="text" class="form-control" id="price" name="price" required="" placeholder="Package Name" value="{{$package->price}}">
								  </div>
								 
								  <div class="form-group">
								    <label for="text">Package Time:</label>
								    <input type="text" class="form-control" id="package_time" name="package_time" required="" placeholder="Package Time" value="{{$package->package_time}}">
								  </div>
								   <div class="form-group">
								    <label for="text">Package Type:</label>
								      <input type="text" class="form-control" id="type" name="type" required="" placeholder="Package Type" value="{{$package->type}}">
								    
								   </div>
								   <div class="form-group">
								    <label for="text">Package Description:</label>
								    <textarea name="description" id="description" class="form-control" required="" type="text" placeholder="Package Description">{{$package->description}}</textarea>
								   </div>
								   
								  
								   
								   <button class="btn ripple btn-info" type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
								
						  </form>
						   @endif