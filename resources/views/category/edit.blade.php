                           @if(!empty($category))
                             <form action="{{url('edit-category-frm/'.$category->category_id)}}" method="post">
								 @csrf
								<div class="form-group">
								    <label for="text">Vehicle Type:</label>
								    <input type="text" class="form-control" id="category_name" name="category_name" required="" value="{{$category->category_name}}" placeholder="Enter Vehicle Type">
								  </div>
								  <!--<div class="form-group">-->
								  <!--  <label for="text">Comission</label>-->
								  <!--  <input type="text" class="form-control" id="comission" name="comission" required="" placeholder="" value="{{$category->comission}}">-->
								  <!--</div>-->
								  <div class="form-group">
								
								    <div class="input-group mb-3">
		                                <label for="text" class="w-100">Vehicle Category:</label>
		                              <input type="text"  id="category_price" class="form-control" placeholder="Enter Vehicle Category">
		                                <div class="input-group-append">
		                                  <span class="input-group-text p-0 border-0 ">
		                                    <button class="btn btn-info plusCat" type="button"><i class="fas fa-plus"></i></button>
		                                  </span>
		                                </div>
		                               <input type="hidden" name="ingredients_input" id="ingredients_input">
		                               </div>
		                               <div class="col-12 mb-4 append">
		                               		@if(count($subcategory)>0)
		                               		@foreach($subcategory as $rows)
		                               		<label class="areas mr-2 removetest"><span class="area-label">{{$rows['subcategory_name']}}<input type="hidden" name="category_price[]" value="{{$rows['subcategory_name']}}"></span><span class="area-label-delete deletecat" ><i class="fas fa-times"></i></span></label>
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