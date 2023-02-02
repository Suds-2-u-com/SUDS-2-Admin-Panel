@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">State List</h4>
									<button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add State</button>
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
												<th class="wd-15p border-bottom-0">S.No</th>
												<th class="wd-15p border-bottom-0">State Name</th>

												<th class="wd-15p border-bottom-0">Country Name</th>
												
												<th class="wd-15p border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>
											@if(count($state)>0)
											@php $i=0; @endphp
											@foreach($state as $rows)
											@php $i++;  @endphp
											<tr>
												<td>{{$i}}</td>
												
												<td>{{$rows['name']}}</td>
												<td>{{country($rows['country_id'])}}</td>
												
												<td>
												  <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows['id']); ?>','states','id');">Delete</a>
														<a class="dropdown-item editDetails" data-id="{{$rows['id']}}" data-url="edit-states" >Edit</a>
														
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
								<h6 class="modal-title" id="changeContent">Add State</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="{{url('create-state')}}" method="post">
								 @csrf
								  <input type="hidden" class="form-control" id="state_name" name="state_name" value="us">
							<div class="modal-body">
								
								   <div class="form-group">
								    <label for="text">Country Name:</label>
								    <select class="form-control" id="country_id" name="country_id" required="" >
								    	<option value="">Select Country</option>
								    	@if(count($country)>0)
								    	@foreach($country as $rows)
								    	<option value="{{$rows->id}}">{{$rows->name}}</option>
								    	@endforeach
								    	@endif
								    </select>
								  </div>

								  <div class="form-group">
								    <label for="text">State Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Enter State Name ">
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
								<h6 class="modal-title" id="changeContent">Edit Details</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="usermodel">
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- row closed -->
@endsection