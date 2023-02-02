                                   @if(!empty($package))
                                   <form action="{{url('edit-package/'.$package->package_id)}}" method="post">
								    @csrf
								   <div class="form-group">
								    <label for="text">Vehicle Type:</label>
								    <select class="form-control" id="category_id" name="category_id" required="" >
								    	<option value="">Select Plan</option>
								    	@if(!empty($category))
								    	@foreach($category as $rows)
								    	 <option value="{{$rows->category_id}}" @if($rows->category_id==$package->category_id) {{'selected'}} @endif>{{$rows->category_name}}</option>
								    	@endforeach
								    	@endif
								    </select>
								  </div> 
								   <div class="form-group">
								    <label for="text">Subcategory:</label>
								    <select class="form-control" id="subcategory_id" name="subcategory_id" required="" >
								    	<option value="">Select Subcategory</option>
								    	@if(count($subcategory)>0)
								    	@foreach($subcategory as $rows)
								    	<option value="{{$rows->subcategory_id}}" @if($rows->subcategory_id==$package->subcategory_id) {{'selected'}} @endif>{{$rows->subcategory_name}}</option>
								    	@endforeach
								    	@endif
								    </select>
								  </div>
                                   <div class="form-group">
								    <label for="text">Package Name:</label>
								    <input type="text" class="form-control" id="package_name" name="package_name" required="" value="{{$package->package_name}}">
								  </div>
								  <div class="form-group">
								    <label for="text">Package Price:</label>
								    <input type="text" class="form-control" id="package_price" name="package_price" required="" value="{{$package->package_price}}">
								  </div>
								  <div class="form-group">
								    <label for="text">Package Time:</label>
								    <input type="text" class="form-control" id="package_time" name="package_time" required="" placeholder="Package Time" value="{{$package->package_time}}">
								  </div>
								  <div class="form-group">
								    <label for="text">Package Description:</label>
								    <textarea name="package_description" id="package_description" class="form-control" required="" type="text">{{$package->package_description}}</textarea>
								  </div>

								   <div id="muladdons">
									   	<div class="row">
									   		@php $addonss=explode(',',$package->addons_id);
									   		$addonsValue=addons($addonss);
									   		@endphp
									   		@if(count($addonsValue)>0)
									   		@foreach($addonsValue as $key=>$rowaddons)
									   		
									   		<div class="col-md-4 mg-t-20 mg-lg-t-0">
												<label class="ckbox"><input type="checkbox" value="{{$rowaddons['id']}}" name="add_ons[]" <?php if(in_array($rowaddons['id'],$addonss)){ echo 'checked'; }?>><span>{{ucfirst($rowaddons['add_ons_name'])}}</span>
												</label>
										    </div>	
										    <br>
										    @endforeach
										    @endif
										   
									   	</div>	
								   </div>
								  <div class="modal-footer">
									<button class="btn ripple btn-info" type="submit">Submit</button>
									<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
								  </div>
								  </form>
								  @endif