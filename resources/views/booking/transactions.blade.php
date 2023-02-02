@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Booking-Transactions</h4>
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
												<th class="wd-15p border-bottom-0">User Name</th>
												<th class="wd-15p border-bottom-0">Payment To</th>
												<!-- <th class="wd-15p border-bottom-0">Commision(%)</th> -->
												<!-- <th class="wd-15p border-bottom-0">Request No</th> -->
												<th class="wd-15p border-bottom-0">Paid Amount</th>
												<th class="wd-15p border-bottom-0">Txn Id</th>
												<th class="wd-15p border-bottom-0">Date</th>
											    <th class="wd-15p border-bottom-0">Payout TrasactionId</th>
												<th class="wd-30p border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>
											@if(!empty($transactions))
											@php $i=0; @endphp
											@foreach($transactions as $rows)
											@php $i++ @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{userName($rows['from_id'])}}</td>
												<td>{{userName($rows['to_id'])}}</td>
												<!-- <td>{{$rows['commmison']}}</td> -->
												<!-- <td>{{$rows['request_id']}}</td> -->
												<td>${{number_format(($rows['amount']/100),2,'.', '')}}</td>
												<td>{{$rows['txn_id']}}</td>
												<td>{{$rows['created_at']}}</td>
												<td>{{$rows['transfer_id']}}</td>								        <td>
												  <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														
														@if($rows['payout_status']==0/*$rows['status']==0*/)
    													<a href="javascript:void(0);" class="showPayform btn btn-info btn-sm dropdown-item" data-id="{{$rows['id']}}">Pay</a>
    													@else
    													<a href="javascript:void(0);" class="showPayform btn btn-info btn-sm dropdown-item" data-id="{{$rows['id']}}">Paid</a>
    													@endif
														<!--<a href="javascript:void(0);" class="showPayoutDetails btn btn-info btn-sm dropdown-item" data-user_id="{{$rows['to_id']}}" data-id="{{$rows['id']}}">Payout</a>-->
														
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
				<div class="modal" id="showpayoutmodel">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Pay Out</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="userpayoutmodel">
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- row closed -->
@endsection