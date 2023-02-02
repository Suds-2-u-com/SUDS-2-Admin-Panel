@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Package List</h4>
									<button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add Package</button>
								</div>
								
							</div>
							<div class="card-body">
								 @if(Session::has('error'))
					                <div class="alert alert-danger">
					                    <button data-dismiss="alert" class="close" type="button">x</button>
					                    <strong>Error!</strong> {{ Session::get('error') }}
					                </div>                       
					            @endif
					            @if(\Session::has('success'))
					                <div class="alert alert-success">{{\Session::get('success') }}<button data-dismiss="alert" class="close" type="button">x</button>
					                </div>
					             @endif
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">S.No</th>
												<th class="wd-15p border-bottom-0">Vehicle Type</th>
												<th class="wd-15p border-bottom-0">Sub Category</th>
												<th class="wd-10p border-bottom-0">Add ONS</th>
												<th class="wd-15p border-bottom-0">Package Name</th>
												<th class="wd-25p border-bottom-0">Package price</th>
												<th class="wd-25p border-bottom-0">Time</th>
												<th class="wd-10p border-bottom-0">Information</th>
												
												<th class="wd-10p border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>
											@if(count($package)>0)
											@php $i=0; @endphp
											@foreach($package as $rows)
											@php $i++; $addonss=explode(',',$rows['addons_id']);@endphp 
											<tr>
												<td>{{$i}}</td>
												<td>{{categoryname($rows['category_id'])}}</td>
												<td>@if(!empty($rows['subcategory_id'])) {{subcategoryname($rows['subcategory_id'])}} @else {{'-'}} @endif</td>
												<td>@if(!empty($rows['addons_id'])) {{addonsname($addonss)}} @else {{'-'}} @endif</td>
												<td>{{$rows['package_name']}}</td>
												<td>{{$rows['package_price']}}</td>
												<td>@if(!empty($rows['package_time'])) {{$rows['package_time']}} @else {{'-'}} @endif</td>
												<td>{{$rows['package_description']}}</td>
												<td>
												  <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows['package_id']); ?>','packages','package_id');">Delete</a>
														<a class="dropdown-item editDetails" data-id="{{$rows['package_id']}}" data-url="edit-package" >Edit</a>
														
													</div>
												</div>


												</td>

											<!-- 	{{url('delete-user/'.encrypt($rows['id']))}} -->
											</tr>
											@endforeach
											@endif
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div>
					<!-- Modal effects -->
				<div class="modal" id="modaldemo1">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Add Packages</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="{{url('create-package')}}" method="post">
								 @csrf
							<div class="modal-body">
								  <div class="form-group">
								    <label for="text">Vehicle Type:</label>
								    <select class="form-control" id="category_id" name="category_id" required="" >
								    	<option value="">Select Type</option>
								    	@if(!empty($category))
								    	@foreach($category as $rows)
								    	 <option value="{{$rows->category_id}}">{{$rows->category_name}}</option>
								    	@endforeach
								    	@endif
								    </select>
								  </div>
								   <div class="form-group">
								    <label for="text">Subcategory:</label>
								    <select class="form-control" id="subcategory_id" name="subcategory_id" required="" >
								    	<option value="">Select Subcategory</option>
								    	
								    </select>
								  </div>

								  <div class="form-group">
								    <label for="text">Package Name:</label>
								    <input type="text" class="form-control" id="package_name" name="package_name" required="" placeholder="Package Name">
								  </div>
								  <div class="form-group">
								    <label for="text">Package Price:</label>
								    <input type="text" class="form-control" id="package_price" name="package_price" required="" placeholder="Package Price">
								  </div>
								  <div class="form-group">
								    <label for="text">Package Time:</label>
								    <input type="text" class="form-control" id="package_time" name="package_time" required="" placeholder="Package Time">
								  </div>
								   <div class="form-group">
								    <label for="text">Package Description:</label>
								    <textarea name="package_description" id="package_description" class="form-control" required="" type="text" placeholder="Package Description"></textarea>
								   </div>
								    <div id="muladdons"></div>
							</div>
							<div class="modal-footer">
								<button class="btn ripple btn-info" type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						  </form>
						</div>
					</div>
				</div>

				<div class="modal" id="showusermodel">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Edit Details</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="usermodel">
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- row closed -->
@endsection