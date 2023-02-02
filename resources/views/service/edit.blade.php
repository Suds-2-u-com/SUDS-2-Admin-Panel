	@if(!empty($service))
	<form action="{{url('edit-service/'.$service->id)}}" method="post">
								 @csrf
<div class="form-group">
								    <label for="text">Service Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" value="{{$service->name}}">
								  </div>
								  <div class="form-group">
								    <label for="text">Service Price:</label>
								    <input type="text" class="form-control" id="price" name="price" required=""  value="{{$service->price}}">
								  </div>
								  	<button class="btn ripple btn-info" type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
								  </form>
								  
								  @endif