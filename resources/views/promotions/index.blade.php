@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Promotions List</h4>
									<button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add Promotions</button>
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
												<th class="wd-15p border-bottom-0">Promotions Start Date</th>
												<th class="wd-15p border-bottom-0">Promotions End Date</th>
												<th class="wd-15p border-bottom-0">Promotions Name</th>
												<th class="wd-15p border-bottom-0">Discount</th>
												<th class="wd-15p border-bottom-0">Type</th>
												<th class="wd-15p border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>

											@if(count($promotions)>0)
											@php $i=0; @endphp
											@foreach($promotions as $rows)
											@php $i++;  @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$rows->start_date}}</td>
												<td>{{$rows->end_date}}</td>
												<td>{{$rows->name}}</td>
										     	<td>{{$rows->discount_amount}}</td>
												<td>{{$rows->type}}</td>
												<td>
												  <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows->id); ?>','promotions','id');">Delete</a>
														<a class="dropdown-item editpro" data-id="{{$rows->id}}" data-url="edit-promotion" >Edit</a>
														
													</div>
												</div>


												</td>

										
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
								<h6 class="modal-title" id="changeContent">Add Promotions</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="{{url('create-promotions')}}" method="post">
								 @csrf
							<div class="modal-body">

								  <div class="form-group">
								    <label for="text">Promotions Name:</label>
								    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Enter Promotions Name">
								  </div>
								   <div class="form-group">
								    <label for="text">Promotions Type:</label>
								    <select name="type" id="type" class="form-control">
								        <option value="">Select Type</option>
								        <option value="free">free</option>
								        <option value="normal">normal</option>
								    </select>
								  </div>
								  <div class="form-group">
								    <label for="text">Discount Amount:</label>
								    <input type="text" class="form-control" id="discount_amount" name="discount_amount" required="" placeholder="Enter Discount Amount">
								  </div>
								  <div class="form-group">
								    <label for="text">Promotions Start Date:</label>
								    <input type="date" class="form-control" id="start_date" name="start_date" required="" placeholder="Enter Start Date">
								  </div>
								  <div class="form-group">
								    <label for="text">Promotions End Date:</label>
								    <input type="date" class="form-control" id="end_date" name="end_date" required="" placeholder="Enter End Date">
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

				<div class="modal" id="showpromotion">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Edit Promotions</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="{{url('update-promotions')}}" method="post">
								 @csrf
							<div class="modal-body" id="usermodelp">
								
							</div>
							<div class="modal-footer">
								<button class="btn ripple btn-info" type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						  </form>
						</div>
					</div>
				</div>
				<!-- row closed -->
				
@endsection