@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Requests</h4>
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
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
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">S.No</th>
												<th class="wd-15p border-bottom-0">First Name</th>
												<th class="wd-15p border-bottom-0">Last Name</th>
												<th class="wd-15p border-bottom-0">Email</th>
												<th class="wd-15p border-bottom-0">Phone</th>
												<th class="wd-50p border-bottom-0">Request Service</th>
												<th class="wd-50p border-bottom-0">City</th>
												<th class="wd-50p border-bottom-0">State</th>
												<th class="wd-50p border-bottom-0">Zip code</th>
												<th class="wd-50p border-bottom-0">Address</th>
												<th class="wd-50p border-bottom-0">Payment type</th>
												<th class="wd-50p border-bottom-0">Howmany vehicles</th>
												<th class="wd-50p border-bottom-0">Property type</th>
												<th class="wd-30p border-bottom-0">Date</th>
												<th class="wd-30p border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>
											@if(!empty($request))
											@php $i=0; @endphp
											@foreach($request as $rows)
											@php $i++ @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$rows['fname']}}</td>
												<td>{{$rows['lname']}}</td>
												
												<td>{{$rows['email']}}</td>
												<td>{{$rows['phone']}}</td>
												<td>{{categoryname($rows['service'])}}</td>
												<td>{{city($rows['city'])}}</td>
												<td>{{state($rows['state'])}}</td>
												<td>{{$rows['zip_code']}}</td>
												<td>{{$rows['address']}}</td>
												<td>{{$rows['payment_method']}}</td>
												<td>{{$rows['how_many']}}</td>
												<td>{{$rows['property_type']}}</td>
												<td>{{$rows['created_at']}}</td>
										      
											    
											
												<td>
													 <a href="javascript:void(0);" class="showrequest" data-id="{{$rows['id']}}" data-url="edit-package" ><i class="fa fa-eye" aria-hidden="true"></i></a>
													 <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														<a class="dropdown-item editRequest" data-id="{{$rows['id']}}" >Edit</a>
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows['id']); ?>','request','id');">Delete</a>
														
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
					<div class="col-lg-12">

					</div>
				</div>
					<!-- Modal effects -->
				<div class="modal" id="showpaymodel">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Pay To Washer</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="userpaymodel">
								
							</div>
							
						</div>
					</div>
				</div>
					<div class="modal" id="showpaymodel1">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Washer List</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="userpaymodel1">
								
							</div>
							
						</div>
					</div>
				</div>
			<div class="modal" id="requestedit">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Edit Details</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="requestmodal">
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- row closed -->
@endsection