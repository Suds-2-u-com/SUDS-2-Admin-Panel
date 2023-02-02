@extends('layout.main')

@section('main-content')
 <!-- main-header -->
		
			<!-- /main-header -->
            <!-- container -->
            <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

										<div class="left-content">
						<h4 class="content-title mb-1">Review List</h4>
						
					</div>

				</div>
				<!-- breadcrumb -->

				
				<!-- Row -->
				<div class="row">
					@if(count($review)>0)
											@php $i=0; @endphp
											@foreach($review as $rows)
											@php $i++ @endphp
					<div class="col-md-6 col-xl-4">
						<div class="card overflow-hidden">
							<div class="card-body d-flex flex-column">
								<h5 class="text-capitalize"><a href="#"> Review</a></h5>
								<div class="text-muted">{{$rows['comment']}}</div>
							</div>
							<div class="card-body">
								<div class="d-flex align-items-center mt-auto">
									<!-- <img class="avatar brround avatar-md mr-3 " src="http://laravel.spruko.com/dashfox/ltr/assets/img/faces/1.jpg" alt="img"> -->
									<div>
										<a href="#" class="font-weight-semibold text-default">{{userName($rows['from_id'])}}</a>
										<small class="d-block text-muted">{{$rows['created_date']}}</small>
									</div>
									<div class="ml-auto text-muted">
										<a href="javascript:void(0)" class="font-weight-semibold text-default">Rating</a>
										<small class="d-block text-muted">{{$rows['rating']}}</small>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@else
                   <div class="col-md-12 col-xl-12">
						<div class="card overflow-hidden">
							<div class="card-body d-flex flex-column">
								<p class="text-capitalize">Not available</p>
								
							</div>
						</div>
					</div>
                    @endif
					
					<div class="col-12">
						<!-- <ul class="pagination float-right">
							<li class="page-item"><a class="page-link bg-white" href="#"><i class="icon ion-ios-arrow-back"></i></a></li>
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link bg-white" href="#">2</a></li>
							<li class="page-item"><a class="page-link bg-white" href="#">3</a></li>
							<li class="page-item"><a class="page-link bg-white" href="#"><i class="icon ion-ios-arrow-forward"></i></a></li>
						</ul> -->
					</div>
				</div>
				<!--End Row-->


            </div>
            <!-- Container closed -->


@endsection