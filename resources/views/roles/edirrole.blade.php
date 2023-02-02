                            <form action="{{url('editrolefrm')}}" method="post">
								 @csrf    
								 @if(count($user)>0)
								 <input type="hidden" name="id" value="<?php echo $user[0]->id;?>">
                                    <div class="form-group">
								    <label for="text">Role:</label>
								    <select name="role_as" id="role_as" class="form-control" required="">
								        <option value="">Select Role</option>
								        <option value="4" <?php if($user[0]->role_as=='4'){ echo 'selected';} ?>>Sub-Admin</option>
								    </select>
								  </div>
								  
								  <div class="form-group">
								    <label for="text">Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Please enter name" value="<?php echo $user[0]->name;  ?>">
								   
								  </div>
								  <div class="form-group">
								    <label for="text">Email:</label>
								    <input type="text" class="form-control" id="email" name="email" required="" placeholder="Please enter email" value="<?php echo $user[0]->email;  ?>">
								   
								  </div>
								  <!--<div class="form-group">-->
								  <!--  <label for="text">Password:</label>-->
								  <!--  <input type="password" class="form-control" id="password" name="password" required="" placeholder="" value="<?php echo $user[0]->password;  ?>">-->
								  <!--</div>-->
								  <div class="form-group">
								    <label for="text">Mobile:</label>
								    <input type="text" class="form-control" id="mobile" name="mobile" required="" placeholder="123-45-678" value="<?php echo $user[0]->mobile;  ?>">
								  </div>
    							<div class="modal-footer">
    								<button class="btn ripple btn-info" type="submit">Submit</button>
    								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    							</div>
							@endif
							</form>