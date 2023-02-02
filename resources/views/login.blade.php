<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	
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


		<!---Skinmodes css-->
		<link href="{{url('public/admin/assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!--- Animations css-->
		<link href="{{url('public/admin/assets/css/animate.css')}}" rel="stylesheet">

	

    </head>
    <body class="main-body light-theme">

		<!-- Loader -->
		<div id="global-loader">
			<img src="{{url('public/admin/assets/img/loader-2.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->

		<!-- main-signin-wrapper -->

        <div class="my-auto page page-h">

            		
		
		<!-- main-signin-wrapper -->
		<div class="my-auto page page-h">
			<div class="main-signin-wrapper error-wrapper">
				<div class="main-card-signin d-md-flex wd-100p">
				<div class="p-5" style="width: 100%;">
					<div class="main-signin-header">
						<!--<h2>Welcome back!</h2>-->
						<h4>Please sign in to continue</h4>
						 @if ($message = Session::get('error'))
						   <div class="alert alert-danger alert-block">
						    <button type="button" class="close" data-dismiss="alert">×</button>
						    <strong >{{ $message }}</strong>
						   </div>
						   @endif
						<form method="post" action="{{ url('/login') }}">
							{!! csrf_field() !!}
							<div class="form-group{{ $errors->has('role_as') ? ' has-error' : '' }}">
								<label>Role As</label>
								<select name="role_as" id="role_as" class="form-control">
								    <option value="">Select Role</option>
								    <option value="1">Admin</option>
								    <option value="4">Sub Admin</option>
								</select>
								@if ($errors->has('role_as'))
                                    <span class="help-block">
                                        <strong class="error">{{ $errors->first('role_as') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label>Email</label>
								<input type="text" class="form-control" placeholder="username" name="email"  autocomplete="false" autofocus="false">
								@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="error">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
								<label>Password</label> <input type="password" id="inputPassword" class="form-control" placeholder="Password"  name="password" autocomplete="false"  autofocus="false">
								@if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="error">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
							 <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
	                            <label class="col-md-4 control-label">Captcha</label>
	                           
	                                {!! app('captcha')->display() !!}
	                                @if ($errors->has('g-recaptcha-response'))
	                                    <span class="help-block">
	                                        <strong class="error">{{ $errors->first('g-recaptcha-response') }}</strong>
	                                    </span>
	                                @endif
	                            
	                        </div>
							<button class="btn btn-main-primary btn-block" type="submit">Sign In</button>
						</form>
					</div>
					
				</div>
			</div>
			</div>
		</div>
		<!-- /main-signin-wrapper -->


        </div>

		<!-- /main-signin-wrapper -->


<!-- Jquery js-->
<script src="{{url('public/admin/assets/plugins/jquery/jquery.min.js')}}"></script>

		<!-- Bootstrap4 js-->
<script src="{{url('public/admin/assets/plugins/bootstrap/popper.min.js')}}"></script>
<script src="{{url('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
 {!! NoCaptcha::renderJs() !!}
		<!-- Ionicons js-->
<script src="{{url('public/admin/assets/plugins/ionicons/ionicons.js')}}"></script>

		<!-- Moment js -->
<script src="{{url('public/admin/assets/plugins/moment/moment.js')}}"></script>

<!-- eva-icons js -->
<script src="{{url('public/admin/assets/plugins/eva-icons/eva-icons.min.js')}}"></script>
  
<!-- Rating js-->
<script src="{{url('public/admin/assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{url('public/admin/assets/plugins/rating/jquery.barrating.js')}}"></script>	

 
 

<!-- custom js -->
<script src="{{url('public/admin/assets/js/custom.js')}}"></script>
        <style type="text/css">
        	strong.error {
			    color: red;
			}
        </style>
	</body>
</html>