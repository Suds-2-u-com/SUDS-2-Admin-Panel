@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="">
									<div class="main-profile-overview">
										<div class="profile-banner relative">
											<img src="{{url('public/admin/assets/img/banner.png')}}" alt="img" class="rounded-10 ht-250 w-100"/>
											<div class="profile-content d-sm-flex">
												@if(!empty($result))
												<div class="main-img-user profile-user mb-0">
													@if(!empty($result->image))
													<img alt="" src="{{url('public/profile/'.$result->image)}}">
													@else
													<img alt="" src="{{url('public/noimg.png')}}">
													@endif
												</div>
												<div class="mg-t-10 mg-sm-t-60 mg-l-10">
												
													<div>
														<h5 class="main-profile-name">{{$result->name}}</h5>
														
													</div>
													
												</div>
												@endif
											</div>
											
										</div>
										<div class="tab-menu-heading mg-t-100">
											<nav class="nav main-nav-line tabs-menu profile-nav-line bg-gray-100 rounded-10">
											
												
												<a class="nav-link" data-toggle="tab" href="#settings">Change Password</a>
											</nav>
										</div>
										<div class="tab-content">
											
											
										
												<div class="card-body border">
													@if ($message = Session::get('error'))
													   <div class="alert alert-danger alert-block">
													    <button type="button" class="close" data-dismiss="alert">×</button>
													    <strong>{{ $message }}</strong>
													   </div>
													   @endif
													<form class="form-horizontal" action="{{url('Change-Password-Frm/'.Auth::id())}}" method="post" enctype="multipart/form-data">
														{!! csrf_field() !!}
														<div class="mb-4 main-content-label"></div>
														
														
														<div class="form-group ">
															<div class="row">
																<div class="col-md-3">
																	<label class="form-label">Old Password</label>
																</div>
																<div class="col-md-9">
																	<input type="text" class="form-control"  placeholder="Old Password"  name="old_password" required="">
																</div>
															</div>
														</div>
														<div class="form-group ">
															<div class="row">
																<div class="col-md-3">
																	<label class="form-label">New Password</label>
																</div>
																<div class="col-md-9">
																	<input type="text" class="form-control"  placeholder="New Password"  name="password" required="">
																</div>
															</div>
														</div>
														<div class="form-group ">
															<div class="row">
																<div class="col-md-3">
																	<label class="form-label">Confirm Password</label>
																</div>
																<div class="col-md-9">
																	<input type="text" class="form-control"  placeholder="Confirm Password"  name="confirm_password" required="">
																</div>
															</div>
														</div>
														
														<button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
													</form>
												</div>
										
										</div>

										<!-- main-profile-overview -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">

					</div>
				</div>
				<!-- row closed -->
@endsection