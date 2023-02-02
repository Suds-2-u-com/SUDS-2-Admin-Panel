@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Free Washes</h4>
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
												<th class="wd-15p border-bottom-0">User Id</th>
												<th class="wd-15p border-bottom-0">Total Booking</th>
											
									
												<th class="wd-30p border-bottom-0">Date</th>

											</tr>
										</thead>
										<tbody>
										   <?php //echo "<pre>";print_r($reward);exit;?>
											@if(!empty($reward))
											<?php $i=0; ?>
											@foreach($reward as $rows)
										
											@if($rows->total>=10)
												<?php $i++; ?>
                                             <tr>
                                                 <td>{{$i}}</td>
                                                 <td>{{$rows->name}}</td>
                                                 <td>{{$rows->user_id}}</td>
                                                 <td>{{$rows->total}}</td>
                                                 <td>{{$rows->created_at}}</td>
                                             </tr>
                                            @endif
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
		
@endsection