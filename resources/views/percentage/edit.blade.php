
								<form action="{{url('add-percentage')}}" method="post">
								 @csrf
								 
                                <input type="hidden" name="washer_id" id="washer_id" value="<?php echo $id; ?>">
								  <div class="form-group">
								    <label for="text">Vendor percentage:</label>
								    <input type="text" class="form-control" id="vendor_percentage" name="vendor_percentage" required="" placeholder="Vendor Percentage" value="@if(!empty($percentage)) {{$percentage->vendor_percentage}} @endif">
								  </div>
								  <div class="form-group">
								    <label for="text">Admin percentage:</label>
								    <input type="text" class="form-control" id="admin_percentage" name="admin_percentage" required="" placeholder="Admin Percentage"  value="@if(!empty($percentage)) {{$percentage->admin_percentage}} @endif">
								  </div>
								  <button class="btn btn-info" type="submit" >Update</button>
								  </form>