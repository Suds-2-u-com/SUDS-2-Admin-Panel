@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">App Requests</h4>
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
												<th class="wd-15p border-bottom-0">Mobile</th>
												
												<th class="wd-30p border-bottom-0">Date</th>
												<th class="wd-30p border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>
											@if(!empty($apprequest))
											@php $i=0; @endphp
											@foreach($apprequest as $rows)
											@php $i++ @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$rows['mobile']}}</td>
												<td>{{$rows['created_at']}}</td>
												<td>
												  <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows['id']); ?>','app_request','id');">Delete</a>
														
														
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
			
				<!-- row closed -->
@endsection