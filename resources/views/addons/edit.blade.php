                                   @if(!empty($addons))
                                   <form action="{{url('edit-add-ons/'.$addons->id)}}" method="post">
								    @csrf
								    <div class="form-group">
								    <label for="text">Vehicle:</label>
								    <select name="package_id" id="package_id" required="" class="form-control">
								    	<option value="">Select Vehicle</option>
								    	@if(!empty($category))
								    	@foreach($category as $rows)
								    	<option value="{{$rows->category_id}}" @if($rows->category_id==$addons->package_id) {{'selected'}} @endif>{{$rows->category_name}}</option>
								    	@endforeach
								    	@endif
								    </select>
								   </div>
                                   <div class="form-group">
								    <label for="text">Add ONS Name:</label>
								    <input type="text" class="form-control" id="add_ons_name" name="add_ons_name" required="" value="{{$addons->add_ons_name}}" placeholder="Enter Add Ons Name">
								  </div>
								  <div class="form-group">
								    <label for="text">Add ONS Price:</label>
								    <input type="text" class="form-control" id="add_ons_price" name="add_ons_price" required="" value="{{$addons->add_ons_price}}" placeholder="Enter Add ONS Price">
								  </div>
								  
								  <div class="modal-footer">
									<button class="btn ripple btn-info" type="submit">Submit</button>
									<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
								  </div>
								  </form>
								  @endif