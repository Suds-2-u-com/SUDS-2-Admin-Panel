@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Roles</h4>
									<button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add Roles</button>
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
									<table class="table text-md-nowrap" >
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">S.No</th>
												<th class="wd-15p border-bottom-0">Name</th>
												<th class="wd-15p border-bottom-0">Email</th>
												<th class="wd-15p border-bottom-0">Mobile</th>
												<th class="wd-15p border-bottom-0">Created At</th>
												<th class="wd-15p border-bottom-0">Permission</th>
												<th class="wd-15p border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>

											@if(count($user)>0)
											@php $i=0; @endphp
											@foreach($user as $rows)
											@php $i++;  @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$rows['name']}}</td>
												<td>{{$rows['email']}}</td>
												<td>{{$rows['mobile']}}</td>
												<td>{{$rows['created_at']}}</td>
												<td><button class="btn btn-info showpermission" data-id="{{$rows['id']}}">Permission</button></td>
												<td>
												  <div class="dropdown btn-group ">
													<button aria-expanded="false" aria-haspopup="true" class="btn btn-sm ripple btn-primary" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
													
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDelete('<?php echo encryption($rows['id']); ?>');">Delete</a>
														<a class="dropdown-item editroleuser" href="javascript:void(0);" data-id="{{$rows['id']}}" >Edit</a>
														
													</div>
												</div>
												</td>
											</tr>
											@endforeach
											@else
											<tr><td>Data not found</td></tr>
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
								<h6 class="modal-title" id="changeContent">Add Role</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="{{url('create-role')}}" method="post">
								 @csrf
							<div class="modal-body">
								
								 

								  <div class="form-group">
								    <label for="text">Role:</label>
								    <select name="role_as" id="role_as" class="form-control" required="">
								        <option value="">Select Role</option>
								        <option value="4">Sub-Admin</option>
								    </select>
								  </div>
								  
								  <div class="form-group">
								    <label for="text">Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Please enter name">
								   
								  </div>
								  <div class="form-group">
								    <label for="text">Email:</label>
								    <input type="text" class="form-control" id="email" name="email" required="" placeholder="Please enter email">
								   
								  </div>
								   <div class="form-group">
								    <label for="text">Password:</label>
								    <input type="password" class="form-control" id="password" name="password" required="" placeholder="******">
								  </div>
								  <div class="form-group">
								    <label for="text">Mobile:</label>
								    <input type="text" class="form-control" id="mobile" name="mobile" required="" placeholder="123-45-678">
								  </div>
								 
								 
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
								<h6 class="modal-title" id="changeContent">Edit Role</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="usermodel">
								
							</div>
							
						</div>
					</div>
				</div>
				
				
				<div class="modal" id="permission">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Permission</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="showpermission">
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- row closed -->
				
@endsection