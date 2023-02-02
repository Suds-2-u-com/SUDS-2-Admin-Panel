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
											
												
												<a class="nav-link" data-toggle="tab" href="#settings">Account Settings</a>
											</nav>
										</div>
										<div class="tab-content">
											
											
										
												<div class="card-body border">
													<form class="form-horizontal" action="{{url('accountSetting/'.Auth::id())}}" method="post" enctype="multipart/form-data">
														{!! csrf_field() !!}
														<div class="mb-4 main-content-label">Account</div>
														@if(!empty($result))
														
														<div class="form-group ">
															<div class="row">
																<div class="col-md-3">
																	<label class="form-label">User Name</label>
																</div>
																<div class="col-md-9">
																	<input type="text" class="form-control"  placeholder="User Name" value="{{$result->name}}" name="name">
																</div>
															</div>
														</div>
														<div class="form-group ">
															<div class="row">
																<div class="col-md-3">
																	<label class="form-label">Email</label>
																</div>
																<div class="col-md-9">
																	<input type="text" class="form-control"  placeholder="Email" value="{{$result->email}}" name="email">
																</div>
															</div>
														</div>
														<div class="form-group ">
															 <div class="row">
																<div class="col-md-3">
																	<label class="form-label">Image</label>
																</div>
																<div class="input-group col-md-9">
																<input type="text" class="form-control browse-file" placeholder="Choose" readonly >
																<label class="input-group-btn">
																	<span class="btn btn-primary br-tl-0 br-bl-0">
																		Browse <input type="file" style="display: none;" name="image">
																	</span>
																</label>
															</div>
															</div> 
															@if(!empty($result->image))
															<img src="{{url('public/profile/'.$result->image)}}" height="50px" width="50px">
															@else
															<img src="{{url('public/noimg.png')}}" height="50px" width="50px">
															@endif
															
														</div>
														@endif
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