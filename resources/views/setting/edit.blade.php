                  @if(!empty($setting))
                       <form action="{{url('update-distance/'.$setting->id)}}" method="post">
								 @csrf
							<div class="modal-body">

								  <div class="form-group">
								    <label for="text">Distance</label>
								    <input type="text" class="form-control" id="distance_fee" name="distance_fee" required="" value="{{$setting->distance_fee}}">
								  </div>
								  <div class="form-group">
								    <label for="text">Price:</label>
								    <input type="text" class="form-control" id="distance_price" name="distance_price" required="" value="{{$setting->distance_price}}">
								  </div> 

							</div>
							<div class="modal-footer">
								<button class="btn ripple btn-info" type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						  </form>
						  @endif