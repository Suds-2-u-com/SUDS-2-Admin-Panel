@if(!empty($country))
<form action="{{url('update-country/'.$country->id)}}" method="post">
								 @csrf
								  <div class="form-group">
								    <label for="text">Sort Name:</label>
								    <input type="text" class="form-control" id="sortname" name="sortname" required="" placeholder="Sort Name" value="{{$country->sortname}}">
								  </div>
								  <div class="form-group">
								    <label for="text">Country Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Country Name" value="{{$country->name}}">
								  </div>
								   <div class="form-group">
								    <label for="text">Phone Code :</label>
								    <input type="text" class="form-control" id="phonecode" name="phonecode" required="" placeholder="Phone Code" value="{{$country->phonecode}}">
								   </div>
								   
							
							<div class="modal-footer">
								<button class="btn ripple btn-info" type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						  </form>
						  @endif