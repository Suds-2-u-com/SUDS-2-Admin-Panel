<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

        <meta charset="UTF-8">
      
		<meta name="csrf-token" content="{{csrf_token() }}">
        <!-- Title -->
		<title> SUDS </title>
        
        <!-- Favicon -->
		<link rel="icon" href="{{url('public/admin/assets/img/brand/favicon.png')}}" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{url('public/admin/assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />

		<!-- Icons css -->
		<link href="{{url('public/admin/assets/plugins/icons/icons.css')}}" rel="stylesheet">

		<!--  Right-sidemenu css -->
		<link href="{{url('public/admin/assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

		<!--  Left-Sidebar css -->
		<link rel="stylesheet" href="{{url('public/admin/assets/css/sidemenu.css')}}">

		<!--- Dashboard-2 css-->
		<link href="{{url('public/admin/assets/css/style.css')}}" rel="stylesheet">
		<link href="{{url('public/admin/assets/css/style-dark.css')}}" rel="stylesheet">

		<!--- Color css-->
		<link id="theme" href="{{url('public/admin/assets/css/colors/color.css')}}" rel="stylesheet">

		<link href="{{url('public/admin/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{url('public/admin/assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
		<link href="{{url('public/admin/assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{url('public/admin/assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
		<link href="{{url('public/admin/assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
		

		

		


		<!---Skinmodes css-->
		<link href="{{url('public/admin/assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!--- Animations css-->
		<link href="{{url('public/admin/assets/css/animate.css')}}" rel="stylesheet">

		
		<link href="{{url('public/admin/assets/css/sweetalert.min.css')}}" rel="stylesheet">

    </head>

    <body  class="main-body light-theme app sidebar-mini active leftmenu-color">

<!-- row -->
				<div class="row">
					<div class="col-lg-6">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="">
									<div class="main-profile-overview">
										
									
										<div class="tab-content">
											
											
										
												<div class="card-body border">
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
													<form class="form-horizontal" action="{{url('save-forget-Password')}}" method="post" enctype="multipart/form-data">
														{!! csrf_field() !!}
														<div class="mb-4 main-content-label"></div>
														<input type="hidden" name="forgetkey" value="{{$ftoken}}">
														
														
													
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
		</div>
	
		<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

		<!-- Jquery js-->
		<script src="{{url('public/admin/assets/plugins/jquery/jquery.min.js')}}"></script>

		<!-- Bootstrap4 js-->
		<script src="{{url('public/admin/assets/plugins/bootstrap/popper.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

		<!-- Ionicons js-->
		<script src="{{url('public/admin/assets/plugins/ionicons/ionicons.js')}}"></script>

		<!-- Moment js -->
		<script src="{{url('public/admin/assets/plugins/moment/moment.js')}}"></script>	

		<!-- P-scroll js -->
		<script src="{{url('public/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>

		<!-- Sidebar js -->
		<script src="{{url('public/admin/assets/plugins/side-menu/sidemenu.js')}}"></script>

	
		<!-- Suggestion js-->
		<script src="{{url('public/admin/assets/plugins/suggestion/jquery.input-dropdown.js')}}"></script>
		<script src="{{url('public/admin/assets/js/search.js')}}"></script>

		<!-- Right-sidebar js -->
		<script src="{{url('public/admin/assets/plugins/sidebar/sidebar.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/sidebar/sidebar-custom.js')}}"></script>

		<!-- Sticky js-->
		<script src="{{url('public/admin/assets/js/sticky.js')}}"></script>

		<!-- eva-icons js -->
		<script src="{{url('public/admin/assets/plugins/eva-icons/eva-icons.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/jszip.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
		<script src="{{url('public/admin/assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>

		<!--Internal  Datatable js -->
		<script src="{{url('public/admin/assets/js/table-data.js')}}"></script>

		<!--Internal Sparkline js -->
		<script src="{{url('public/admin/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

		<!-- Moment js -->
		<script src="{{url('public/admin/assets/plugins/raphael/raphael.min.js')}}"></script>



	

	
		<script src="{{url('public/admin/assets/js/index.js')}}"></script>


		<!-- custom js -->
		<script src="{{url('public/admin/assets/js/custom.js')}}"></script>
        <script src="{{url('public/custom.js')}}"></script>
        <script src="{{url('public/admin/assets/js/sweetalert.min.js')}}"></script>
	     <script type="text/javascript">
              var APP_URL = {!! json_encode(url('/')) !!}
                var secure_token = '{{ csrf_token() }}';
          </script>
    </body>


</html>