@extends('layout.main')

@section('main-content')

				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{$title}}</h4>
                                         <!--<a class="md-trigger btn btn-info btn-sm add-details" id="send_email" href="javascript:;" data-modal="modal-44">-->
                                         <!--     Send Mail <span class="badge"></span>-->
                                         <!--  </a>-->
								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive"> 
		
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
											    
												<th class=" border-bottom-0">S.No</th>
												<th class=" border-bottom-0">Full Name</th>
												<th class=" border-bottom-0">Email</th>
												<th class=" border-bottom-0">Mobile</th>
												<th class="border-bottom-0">City</th>
												<th class=" border-bottom-0">Subject</th>
												<th class=" border-bottom-0">Message</th>
												<th class=" border-bottom-0">Date</th>
											</tr>
										</thead>
										<tbody>
											@if(!empty($user))
											@php $i=0; @endphp
											@foreach($user as $rows)
											@php $i++ @endphp
											<tr>
											  
												<td>{{$i}}</td>
												<td>{{userName($rows->user_id)}}</td>
												<td><?php echo userEmails($rows->user_id); ?></td>
												<td><?php echo userMobile($rows->user_id); ?></td>
												<td><?php echo city(cityUserid($rows->user_id));?></td>
												<td>{{$rows->subject}}</td>
												<td><?php echo str_replace('<p>','',$rows->message); ?></td>
												<td>{{$rows->created_at}}</td>
											
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

				
			
@endsection