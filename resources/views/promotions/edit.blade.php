 
<?php if(!empty($promotions)){?>

<input type="hidden" id="id" name="id" value="<?php echo $promotions->id ?>">
 <div class="form-group">
								    <label for="text">Promotions Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" value="<?php echo $promotions->name; ?>" placeholder="Enter Promotions Name">
								  </div>
								  
								   <div class="form-group">
								    <label for="text">Promotions Type:</label>
								    <select name="type" id="type" class="form-control">
								        <option value="">Select Type</option>
								        <option value="free" <?php if($promotions->type=='free'){ echo 'selected';} ?>>Free</option>
								        <option value="normal" <?php if($promotions->type=='normal'){ echo 'selected';} ?>>Normal</option>
								    </select>
								  </div>
								  <div class="form-group">
								    <label for="text">Discount Amount:</label>
								    <input type="text" class="form-control" id="discount_amount" name="discount_amount" required="" value="<?php echo $promotions->discount_amount; ?>" placeholder="Enter Promotions Name">
								  </div>
								  
								  <div class="form-group">
								    <label for="text">Promotions Start Date:</label>
								    <input type="date" class="form-control" id="start_date" name="start_date" required="" value="<?php echo $promotions->start_date; ?>"  placeholder="Enter Start Date">
								  </div>
								  <div class="form-group">
								    <label for="text">Promotions End Date:</label>
								    <input type="date" class="form-control" id="end_date" name="end_date" required="" value="<?php echo $promotions->end_date; ?>" placeholder="Enter End Date">
								  </div>
								  
								  <?php } ?>