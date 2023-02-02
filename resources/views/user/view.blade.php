
	<form action="{{url('update-customer-details')}}" method="post">
								 @csrf
								 
						
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $id; ?>">
								  <div class="form-group">
								    <label for="text">Phone number:</label>
								    <input type="text" class="form-control" id="phone_number" name="phone_number" required="" placeholder="Please enter your mobile no." value="<?php if(!empty($user)){ echo $user->phone_number; }  ?>">
								  </div>
								  
								   <div class="form-group">
								    <label for="text">Preferred Method Of Contact:</label>
								    <input type="text" class="form-control" id="preferred_method_of_contact" name="preferred_method_of_contact" required="" placeholder="Please enter preferred method of contact" value="<?php if(!empty($user)){ echo $user->preferred_method_of_contact; }  ?>">
								  </div>
								   <div class="form-group">
								    <label for="text">Complete Address:</label>
								    <input type="text" class="form-control" id="complete_address" name="complete_address" required="" placeholder="Please enter complete address" value="<?php if(!empty($user)){ echo $user->complete_address; }  ?>">
								  </div>
								  
								    <div class="form-group">
								    <label for="text">Country:</label>
								    <select id="country" name="country" class="form-control">
								        <option>Select Country</option>
								        @if(!empty($country))
								        @foreach($country as $rows)
								        <option value="{{$rows->id}}" <?php if(!empty($user)){ if($user->country==$rows->id){ echo "selected"; } }  ?>>{{$rows->name}}</option>
								        @endforeach
								        @endif
								    </select>
								
								  </div>
								  <div class="form-group">
								    <label for="text">State:</label>
								    <select id="state" name="state" class="form-control" >
								        @if(!empty($user->country))
								        @if(!empty($state))
								        @foreach($state as $rowss)
								        <option value="{{$rowss->id}}" <?php if(!empty($user)){ if($user->state==$rowss->id){ echo "selected"; } }  ?>>{{$rowss->name}}</option>
								        @endforeach
								        @endif
								        @else
								        <option></option>
								        @endif
								        
								    </select>
								
								  </div>
								  <div class="form-group">
								    <label for="text">City:</label>
								    <select id="city" name="city" class="form-control">
								        @if(!empty($user->city))
								        @if(!empty($city))
								        @foreach($city as $rowsc)
								        <option value="{{$rowsc->id}}" <?php if(!empty($user)){ if($user->city==$rowsc->id){ echo "selected"; } }  ?> >{{$rowsc->name}}</option>
								        @endforeach
								        @endif
								        @else
								        <option></option>
								        @endif
								        
								    </select>
								
								  </div>
								  
								  
								<button class="btn ripple btn-info"  type="submit">Submit</button>
							
							 </form>
