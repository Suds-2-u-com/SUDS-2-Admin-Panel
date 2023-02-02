@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Booking List</h4>
									
								</div>
								
							</div>
							<div class="card-body">
								
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">S.No</th>
												<th class="wd-15p border-bottom-0">Customer Name</th>
												<th class="wd-15p border-bottom-0">Washer Name</th>
												<th class="wd-15p border-bottom-0">Vehicle Name</th>
												<th class="wd-25p border-bottom-0">Booking Date and Time</th>
												<th class="wd-15p border-bottom-0">Package</th>
												<th class="wd-15p border-bottom-0">Status</th>
										    	<?php	if(Auth::user()->role_as=='1'){ ?>
												<th class="wd-15p border-bottom-0">Action</th>
                                                <?php } ?>
											</tr>
										</thead>
										<tbody>
											@if(count($booking)>0)
											@php $i=0; @endphp
											@foreach($booking as $rows)
											@php $i++; @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{userName($rows['user_id'])}}</td>
												<td>{{userName($rows['washer_id'])}}</td>
												<td>@if(!empty($rows['vehicle_id'])) {{vehicleName($rows['vehicle_id'])}} @else {{'-'}} @endif</td>
												<td>{{$rows['booking_date']}} {{$rows['booking_time']}}</td>
												<td>{{packages($rows['package'])}}</td>
												<td>
													@if($rows['status']==0)
												Pending
												@elseif($rows['status']==1)
												accept
												@else
												Decline
												@endif
											    </td>
											    <?php	if(Auth::user()->role_as=='1'){ ?>
												<td>
													 <a href="javascript:void(0);" class="showBooking" data-id="{{$rows['booking_id']}}" data-url="edit-package" ><i class="fa fa-eye" aria-hidden="true"></i></a>

												</td>
                                                <?php } ?>
										
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
		<div class="modal" id="bookingmodel">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Booking Number</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body" id="userbookingmodel">
						
					</div>
					
				</div>
			</div>
		</div>
				<!-- row closed -->
@endsection