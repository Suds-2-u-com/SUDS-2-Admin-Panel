	@if(!empty($alluser))
	<form action="{{url('update-customer/'.$alluser->id)}}" method="post">
@csrf
<div class="form-group">
								    <label for="text">Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Please enter your name" value="{{$alluser->name}}">
								  </div>
								  
								   <div class="form-group">
								    <label for="text">Email:</label>
								    <input type="text" class="form-control" id="email" name="email" required="" placeholder="Please enter your email" value="{{$alluser->email}}">
								  </div>
								   <div class="form-group">
								    <label for="text">Password:</label>
								    <input type="text" class="form-control" id="password" name="password" required="" placeholder="Please enter your password" readonly value="{{$alluser->password}}">
								  </div>
								  
								  <div class="form-group">
								    <label for="text">Mobile:</label>
								    <input type="text" class="form-control" id="mobile" name="mobile" required="" placeholder="Please enter your mobile" value="{{$alluser->mobile}}">
								  </div>
								  
								  
								  <div class="form-group">
								    <label for="text">Image:</label>
								    <input type="file" class="form-control" id="image" name="image" >
								    <img src="{{url('public/profile/'.$alluser->image)}}" width="50px" height='50px'>
								  </div>
								  		<button class="btn ripple btn-info"  type="submit">Submit</button>
</form>								  
@endif