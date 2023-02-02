@extends('layout.main')

@section('main-content')

				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Washer Mailing List </h4>
                                    
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
											  
												<th class=" border-bottom-0">S.No</th>
												<th class=" border-bottom-0">Name</th>
												<th class=" border-bottom-0">Email</th>
												<th class=" border-bottom-0">Mobile</th>
												<th class="border-bottom-0">City</th>
												<th class=" border-bottom-0">Message</th>
										        <th class=" border-bottom-0">Date</th>
												<th class=" border-bottom-0">Action</th>
											</tr>
										</thead>
										<tbody>
										  
											@if(!empty($mail))
											@php $i=0; @endphp
											@foreach($mail as $rows)
											
											
											@php $i++ @endphp
											<tr>
											    
												<td>{{$i}}</td>
												<td><?php echo userName($rows->user_id); ?></td>
												<td><?php echo userEmails($rows->user_id); ?></td>
												<td><?php echo userMobile($rows->user_id); ?></td>
												<td><?php echo city(cityUserid($rows->user_id));?></td>
												<td><?php echo $rows->message; ?></td>
											    <td><?php echo $rows->created_at; ?></td>
												<td>
												  <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows->id); ?>','mail','id');">Delete</a>
														
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

				
			
@endsection