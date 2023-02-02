@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Fleet Requests</h4>
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
												<th class="wd-15p border-bottom-0">Name</th>
												<th class="wd-15p border-bottom-0">Email</th>
												<th class="wd-15p border-bottom-0">Company Name</th>
												<th class="wd-15p border-bottom-0">Phone Number</th>
												<th class="wd-15p border-bottom-0">Property Type</th>
												<th class="wd-15p border-bottom-0">Country</th>
												<th class="wd-15p border-bottom-0">State</th>
												<th class="wd-15p border-bottom-0">City</th>
												<th class="wd-15p border-bottom-0">Zip Code</th>
												<th class="wd-15p border-bottom-0">Address</th>
												<th class="wd-15p border-bottom-0">How Many</th>
												<th class="wd-15p border-bottom-0">Payment Method</th>
												<th class="wd-30p border-bottom-0">Date</th>
												<th class="wd-30p border-bottom-0">Status</th>		
												<th class="wd-30p border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>
											@if(!empty($pressrequest))
											@php $i=0; @endphp
											@foreach($pressrequest as $rows)
											@php $i++ @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$rows['first_name']}} {{$rows['last_name']}}</td>
												<td>{{$rows['email']}}</td>
												<td>{{$rows['company_name']}}</td>
												<td>{{$rows['phone_number']}}</td>
												<td>{{$rows['property_type']}}</td>
												<td>{{country($rows['country'])}}</td>
												<td>{{state($rows['state'])}}</td>
												<td>{{city($rows['city'])}}</td>
												<td>{{$rows['zip_code']}}</td>
												<td>{{$rows['address']}}</td>
												<td>{{$rows['how_many']}}</td>
												<td>@if($rows['payment_method']!='') {{$rows['payment_method']}} @else -  @endif</td>
												<td>{{$rows['created_at']}}</td>
												<!-- <td>
												  <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows['id']); ?>','press_request','id');">Delete</a>
														
														
													</div>
												</div>
												</td> -->
												<td><?php if($rows['status']==0){ ?>Pending<?php }elseif($rows['status']==1){ ?>Accepted <?php }else{ ?>Rejected <?php } ?></td>
												<td>
												  <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
													    <a class="dropdown-item editPressRequest" data-id="{{$rows['id']}}" >Edit</a>
														<?php if($rows['status']==0){?>
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows['id']); ?>','press_request','id');">Delete</a>
													
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmAcceptEntry('<?php echo encryption($rows['id']); ?>','press_request','id');">Accept</a>
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmRejectEntry('<?php echo encryption($rows['id']); ?>','press_request','id');">Reject</a>
												        <?php }elseif($rows['status']==1){?>
												        <a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows['id']); ?>','press_request','id');">Delete</a>
												        <a class="dropdown-item" href="javascript:void(0);" onclick="return confirmRejectEntry('<?php echo encryption($rows['id']); ?>','press_request','id');">Reject</a>
												        <?php }else{ ?>
												        <a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows['id']); ?>','press_request','id');">Delete</a>
												        <a class="dropdown-item" href="javascript:void(0);" onclick="return confirmAcceptEntry('<?php echo encryption($rows['id']); ?>','press_request','id');">Accept</a>
												        
												        <?php }?>
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
			<div class="modal" id="pressrequestedit">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Edit Details</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="pressrequestmodal">
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- row closed -->
@endsection