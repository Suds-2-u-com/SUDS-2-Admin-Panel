@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Customer List</h4>
									<button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add Customer</button>
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class=" border-bottom-0">S.No</th>
												<th class=" border-bottom-0">Full Name</th>
												<th class=" border-bottom-0">Email Address</th>
												<th class=" border-bottom-0">Phone Number</th>
												<th class=" border-bottom-0">Vehicle</th>
												<th class=" border-bottom-0">Review List</th>
												<th class=" border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>
											@if(!empty($user))
											@php $i=0; @endphp
											@foreach($user as $rows)
											@php $i++ @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$rows['name']}}</td>
												<td>{{$rows['email']}}</td>
												<td>{{$rows['mobile']}}</td>
												<td><a href="javascript:void(0);" class="showVehicle btn btn-info btn-sm" data-id="{{$rows['id']}}">View Vehicle</a></td>
												 <td>
													<a href='{{url("CustomerReviewlist/$rows->id")}}'  class="btn btn-info btn-sm" >View Review</a></td>
											
												<td>
													
												<div class="dropdown btn-group  ">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDelete('<?php echo encryption($rows['id']); ?>');">Delete</a>
														<a class="dropdown-item edituser" href="javascript:void(0);" data-id="{{$rows['id']}}"  >Edit</a>
														<a class="dropdown-item showbasicDetails" href="javascript:void(0);" data-id="{{$rows['id']}}"  >View Profile Details</a>
														<a class="dropdown-item showDetails" href="javascript:void(0);" data-id="{{$rows['id']}}"  >Update Extra Profile Details</a>
														
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
					<div class="col-lg-12">

					</div>
				</div>
					<!-- Modal effects -->
				<div class="modal" id="showusermodel">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">View All Details</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="usermodel">
								
							</div>
							<div class="modal-footer">
								
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						</div>
					</div>
				</div>
			
				<!-- row closed -->
				
					<div class="modal" id="modaldemo1">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Add Customer</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="{{url('create-customer')}}" method="post">
								 @csrf
							<div class="modal-body" id="usermodel">
								
								  <div class="form-group">
								    <label for="text">Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Please enter your name">
								  </div>
								  
								   <div class="form-group">
								    <label for="text">Email:</label>
								    <input type="text" class="form-control" id="email" name="email" required="" placeholder="Please enter your email">
								  </div>
								   <div class="form-group">
								    <label for="text">Password:</label>
								    <input type="text" class="form-control" id="password" name="password" required="" placeholder="Please enter your password">
								  </div>
								  
								  <div class="form-group">
								    <label for="text">Mobile:</label>
								    <input type="text" class="form-control" id="mobile" name="mobile" required="" placeholder="Please enter your mobile">
								  </div>
								  
								  
								  <div class="form-group">
								    <label for="text">Image:</label>
								    <input type="file" class="form-control" id="image" name="image" required="">
								  </div>
								  
								  
								
							</div>
							<div class="modal-footer">
									<button class="btn ripple btn-info"  type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
							 </form>
						</div>
					</div>
				</div>
@endsection