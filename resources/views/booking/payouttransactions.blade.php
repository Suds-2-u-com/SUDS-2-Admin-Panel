@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Transaction List</h4>
									
								</div>
								
							</div>
							<div class="card-body">
								
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">S.No</th>
												<th class="wd-15p border-bottom-0">Washer Name</th>
												<th class="wd-15p border-bottom-0">Amount</th>
												<th class="wd-25p border-bottom-0">Date</th>
											
												<th class="wd-15p border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>
											@if(count($transactions)>0)
											@php $i=0; @endphp
											@foreach($transactions as $rows)
											@php $i++; @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{userName($rows['washer_id'])}}</td>
												<td>${{number_format(($rows['amount']/100),2,'.', '')}}</td>
												<td>{{$rows['created_at']}}</td>
											
											
												<td>
												  <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows['id']); ?>','transaction','id');">Delete</a>
													
														
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
	
@endsection