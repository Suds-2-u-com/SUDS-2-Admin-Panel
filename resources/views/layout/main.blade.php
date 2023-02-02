<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{csrf_token() }}">
    <!-- Title -->
    <title> SUDS </title>

    <!-- Favicon -->
    <link rel="icon" href="{{url('public/admin/assets/img/brand/favicon.png')}}" type="image/x-icon" />

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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

</head>

<body class="main-body light-theme app sidebar-mini active leftmenu-color">



    <!-- Loader -->
    <div id="global-loader">
        <img src="{{url('public/admin/assets/img/loader-2.svg')}}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- main-sidebar -->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="main-sidebar-header active">
            <a class="desktop-logo logo-light active" href="{{url('Dashboard')}}">
                <img src="assets/img/brand/logo.png" class="main-logo logo-color1" alt="logo">
                <img src="assets/img/brand/logo2.png" class="main-logo logo-color2" alt="logo">
                <img src="assets/img/brand/logo3.png" class="main-logo logo-color3" alt="logo">
                <img src="assets/img/brand/logo4.png" class="main-logo logo-color4" alt="logo">
                <img src="assets/img/brand/logo5.png" class="main-logo logo-color5" alt="logo">
                <img src="assets/img/brand/logo6.png" class="main-logo logo-color6" alt="logo">
            </a>
            <a class="desktop-logo logo-dark active" href="{{url('Dashboard')}} "><img
                    src="{{url('public/admin/Group.png')}}" class="main-logo dark-theme" alt="logo"></a>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-chevron-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icon fe fe-chevron-right"></i></a>
            </div>
        </div>
        <div class="main-sidemenu sidebar-scroll">
            <ul class="side-menu">
                <li>
                    <h3>Main</h3>
                </li>

                <li class="slide">
                    <a class="side-menu__item" href="{{url('Dashboard')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <?php 

                 
                 if(Auth::id()!=1) {
                 if(!empty(permission(Auth::id()))){
                
                  $per=json_decode(permission(Auth::id()));  
                 
                  if(in_array("view_state", $per)){
                ?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('State')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z"
                                opacity=".3" />
                            <path
                                d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z" />
                        </svg>
                        <span class="side-menu__label">State</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_city", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('City')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">City</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_Promotions", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Promotions')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Promotions</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_coupon", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('coupon')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Coupon</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_washer", $per)){
				?>
                <li class="slide <?php if(request()->segment(1)=='WasherReviewlist'){echo 'active';} ?>">
                    <a class="side-menu__item <?php if(request()->segment(1)=='WasherReviewlist'){echo 'active';} ?>"
                        href="{{url('Washer-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M17 7H7V4H5v16h14V4h-2z" opacity=".3" />
                            <path
                                d="M19 2h-4.18C14.4.84 13.3 0 12 0S9.6.84 9.18 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm7 18H5V4h2v3h10V4h2v16z" />
                        </svg>
                        <span class="side-menu__label">Washer</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_customer", $per)){
				?>
                <li class="slide <?php if(request()->segment(1)=='CustomerReviewlist'){echo 'active';} ?>">
                    <a class="side-menu__item <?php if(request()->segment(1)=='CustomerReviewlist'){echo 'active';} ?>"
                        href="{{url('Customer-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3.19L5 6.3V12h7v8.93c3.72-1.15 6.47-4.82 7-8.94h-7v-8.8z" opacity=".3" />
                            <path
                                d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 19.93V12H5V6.3l7-3.11v8.8h7c-.53 4.12-3.28 7.79-7 8.94z" />
                        </svg>
                        <span class="side-menu__label">Customer</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_washtype", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Category-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Wash Types</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_addons", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Add-ONS-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M17 7H7V4H5v16h14V4h-2z" opacity=".3" />
                            <path
                                d="M19 2h-4.18C14.4.84 13.3 0 12 0S9.6.84 9.18 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm7 18H5V4h2v3h10V4h2v16z" />
                        </svg>
                        <span class="side-menu__label">Add ONS</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_package", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Packages-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3.19L5 6.3V12h7v8.93c3.72-1.15 6.47-4.82 7-8.94h-7v-8.8z" opacity=".3" />
                            <path
                                d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 19.93V12H5V6.3l7-3.11v8.8h7c-.53 4.12-3.28 7.79-7 8.94z" />
                        </svg>
                        <span class="side-menu__label">Packages</span>
                    </a>
                </li>
                <?php }
					  if(Auth::user()->role_as=='1'){ ?>

                <!--	<li class="slide">-->
                <!--	<a class="side-menu__item" href="{{url('On-Demand-Packages-List')}}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>-->
                <!--	<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3.19L5 6.3V12h7v8.93c3.72-1.15 6.47-4.82 7-8.94h-7v-8.8z" opacity=".3"/><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 19.93V12H5V6.3l7-3.11v8.8h7c-.53 4.12-3.28 7.79-7 8.94z"/></svg>-->
                <!--	<span class="side-menu__label">On Demand Packages</span></a>-->
                <!--</li>-->


                <li class="slide">
                    <a class="side-menu__item" href="{{url('Booking-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Booking</span>
                    </a>
                </li>


                <li class="slide">
                    <a class="side-menu__item" href="{{url('Booking-Transactions')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Booking Payout</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" href="{{url('Payout-Transactions')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Payout Transactions</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_request", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Requests')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Requests</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_app_rquest", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('App-Request')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">App Requests</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_on_site_request", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('On-Site-Request')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">On Site Request</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_press_request", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Press-Request')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Fleet Request</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_job_mailing", $per)){
				?>
                <!--<li class="slide">-->
                <!--	<a class="side-menu__item" href="{{url('percentage-adjustable')}}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>-->
                <!--	<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg>-->
                <!--	<span class="side-menu__label">Percentage Adjustable</span></a>-->
                <!--</li>-->
                <li class="slide">
                    <a class="side-menu__item" href="{{url('mailing-list')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Job Mailing List</span>
                    </a>
                </li>
                <?php }
				 if(in_array("view_free_wash", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('free_washes')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Free Washes </span>
                    </a>
                </li>
                <?php }
				 if(Auth::user()->role_as=='1'){ 
				?>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1 14h-2v-2h2v2zm0-3h-2c0-3.25 3-3 3-5 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 2.5-3 2.75-3 5z"
                                opacity=".3" />
                            <path
                                d="M11 16h2v2h-2zm1-14C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" />
                        </svg>
                        <span class="side-menu__label">Send E-mail</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('send_mail')}}"><span
                                    class="sub-side-menu__label">Send Mail</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                        <!--<li class="sub-slide">-->
                        <!--	<a class="sub-side-menu__item" href="{{url('washer-mailing-list')}}"><span class="sub-side-menu__label">Washer Mailing list</span><i class="sub-angle fe fe-chevron-right"></i></a>-->

                        <!--</li>-->

                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('sent_mail')}}"><span
                                    class="sub-side-menu__label">Sent Mail To User</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('sent_mail_washer')}}"><span
                                    class="sub-side-menu__label">Sent Mail To Washer</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                    </ul>
                </li>
                <?php }
				 if(in_array("view_distance", $per) || in_array("view_extra_time", $per) || in_array("view_service", $per)){
				?>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1 14h-2v-2h2v2zm0-3h-2c0-3.25 3-3 3-5 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 2.5-3 2.75-3 5z"
                                opacity=".3" />
                            <path
                                d="M11 16h2v2h-2zm1-14C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" />
                        </svg>
                        <span class="side-menu__label">Settings</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <?php if(in_array("view_distance", $per)){ ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('Distance')}}"><span
                                    class="sub-side-menu__label">Distance</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                        <?php }
			                if(in_array("view_extra_time", $per)){
			            	?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('Extra-Minutes-Hours')}}"><span
                                    class="sub-side-menu__label">Extra Time</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                        <?php }  if(in_array("view_service", $per)){ ?>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('Service')}}"><span
                                    class="sub-side-menu__label">Service</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <?php } } }else{ ?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Roles')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Roles</span>
                    </a>
                </li>
                <!--<li class="slide">-->
                <!--	<a class="side-menu__item" href="{{url('Country')}}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>-->
                <!--	<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/></svg>-->
                <!--	<span class="side-menu__label">Country</span></a>-->
                <!--</li>-->
                <li class="slide">
                    <a class="side-menu__item" href="{{url('State')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z"
                                opacity=".3" />
                            <path
                                d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z" />
                        </svg>
                        <span class="side-menu__label">State</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('City')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">City</span>
                    </a>
                </li>
                
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Promotions')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Promotions</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('coupon')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Coupon</span>
                    </a>
                </li>
                <li class="slide <?php if(request()->segment(1)=='WasherReviewlist'){echo 'active';} ?>">
                    <a class="side-menu__item <?php if(request()->segment(1)=='WasherReviewlist'){echo 'active';} ?>"
                        href="{{url('Washer-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M17 7H7V4H5v16h14V4h-2z" opacity=".3" />
                            <path
                                d="M19 2h-4.18C14.4.84 13.3 0 12 0S9.6.84 9.18 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm7 18H5V4h2v3h10V4h2v16z" />
                        </svg>
                        <span class="side-menu__label">Washer</span>
                    </a>
                </li>
                <li class="slide <?php if(request()->segment(1)=='CustomerReviewlist'){echo 'active';} ?>">
                    <a class="side-menu__item <?php if(request()->segment(1)=='CustomerReviewlist'){echo 'active';} ?>"
                        href="{{url('Customer-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3.19L5 6.3V12h7v8.93c3.72-1.15 6.47-4.82 7-8.94h-7v-8.8z" opacity=".3" />
                            <path
                                d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 19.93V12H5V6.3l7-3.11v8.8h7c-.53 4.12-3.28 7.79-7 8.94z" />
                        </svg>
                        <span class="side-menu__label">Customer</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Washer-Cities')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Customer City Inquires</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Category-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Wash Types</span>
                    </a>
                </li>
                
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Add-ONS-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M17 7H7V4H5v16h14V4h-2z" opacity=".3" />
                            <path
                                d="M19 2h-4.18C14.4.84 13.3 0 12 0S9.6.84 9.18 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm7 18H5V4h2v3h10V4h2v16z" />
                        </svg>
                        <span class="side-menu__label">Add ONS</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Packages-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3.19L5 6.3V12h7v8.93c3.72-1.15 6.47-4.82 7-8.94h-7v-8.8z" opacity=".3" />
                            <path
                                d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 19.93V12H5V6.3l7-3.11v8.8h7c-.53 4.12-3.28 7.79-7 8.94z" />
                        </svg>
                        <span class="side-menu__label">Packages</span>
                    </a>
                </li>
                <!--	<li class="slide">-->
                <!--	<a class="side-menu__item" href="{{url('On-Demand-Packages-List')}}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>-->
                <!--	<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3.19L5 6.3V12h7v8.93c3.72-1.15 6.47-4.82 7-8.94h-7v-8.8z" opacity=".3"/><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 19.93V12H5V6.3l7-3.11v8.8h7c-.53 4.12-3.28 7.79-7 8.94z"/></svg>-->
                <!--	<span class="side-menu__label">On Demand Packages</span></a>-->
                <!--</li>-->
                <li class="slide">
                    <a class="side-menu__item" href="{{url('On-Demand-Packages-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3.19L5 6.3V12h7v8.93c3.72-1.15 6.47-4.82 7-8.94h-7v-8.8z" opacity=".3" />
                            <path
                                d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 19.93V12H5V6.3l7-3.11v8.8h7c-.53 4.12-3.28 7.79-7 8.94z" />
                        </svg>
                        <span class="side-menu__label">Washer Packages</span>
                    </a>
                </li>

				<li class="slide">
                    <a class="side-menu__item" href="{{url('Washer-Earning-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3.19L5 6.3V12h7v8.93c3.72-1.15 6.47-4.82 7-8.94h-7v-8.8z" opacity=".3" />
                            <path
                                d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 19.93V12H5V6.3l7-3.11v8.8h7c-.53 4.12-3.28 7.79-7 8.94z" />
                        </svg>
                        <span class="side-menu__label">Washer Earning</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" href="{{url('Booking-List')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Booking</span>
                    </a>
                </li>
                <?php  if(Auth::user()->role_as=='1'){ ?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Booking-Transactions')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Booking Payout</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" href="{{url('Payout-Transactions')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
                            <path
                                d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
                        </svg>
                        <span class="side-menu__label">Payout Transactions</span>
                    </a>
                </li>
                <?php } ?>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Requests')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Requests</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" href="{{url('App-Request')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">App Requests</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('On-Site-Request')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">On Site Request</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{url('Press-Request')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Fleet Request</span>
                    </a>
                </li>
                <!--<li class="slide">-->
                <!--	<a class="side-menu__item" href="{{url('percentage-adjustable')}}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>-->
                <!--	<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg>-->
                <!--	<span class="side-menu__label">Percentage Adjustable</span></a>-->
                <!--</li>-->
                <li class="slide">
                    <a class="side-menu__item" href="{{url('mailing-list')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Job Mailing List</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" href="{{url('free_washes')}}">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="side-menu__label">Free Washes </span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1 14h-2v-2h2v2zm0-3h-2c0-3.25 3-3 3-5 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 2.5-3 2.75-3 5z"
                                opacity=".3" />
                            <path
                                d="M11 16h2v2h-2zm1-14C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" />
                        </svg>
                        <span class="side-menu__label">Send E-mail</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('send_mail')}}"><span
                                    class="sub-side-menu__label">Send Mail</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                        <!--<li class="sub-slide">-->
                        <!--	<a class="sub-side-menu__item" href="{{url('washer-mailing-list')}}"><span class="sub-side-menu__label">Washer Mailing list</span><i class="sub-angle fe fe-chevron-right"></i></a>-->

                        <!--</li>-->

                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('sent_mail')}}"><span
                                    class="sub-side-menu__label">Sent Mail To User</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('sent_mail_washer')}}"><span
                                    class="sub-side-menu__label">Sent Mail To Washer</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <div class="side-angle1"></div>
                        <div class="side-angle2"></div>
                        <div class="side-arrow"></div>
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1 14h-2v-2h2v2zm0-3h-2c0-3.25 3-3 3-5 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 2.5-3 2.75-3 5z"
                                opacity=".3" />
                            <path
                                d="M11 16h2v2h-2zm1-14C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" />
                        </svg>
                        <span class="side-menu__label">Settings</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('Distance')}}"><span
                                    class="sub-side-menu__label">Distance</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                        
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('Extra-Minutes-Hours')}}"><span
                                    class="sub-side-menu__label">Extra Time</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('Service')}}"><span
                                    class="sub-side-menu__label">Service</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" href="{{url('Radius')}}"><span
                                    class="sub-side-menu__label">Set Washer Radius</span><i
                                    class="sub-angle fe fe-chevron-right"></i></a>

                        </li>
                    </ul>
                </li>

                <?php }?>

            </ul>

        </div>
    </aside>
    <!-- main-sidebar -->
    <!-- main-content -->
    <div class="main-content app-content">

        <!-- main-header -->
        <div class="main-header sticky side-header nav nav-item">
            <div class="container-fluid">
                <div class="main-header-left">
                    <div class="responsive-logo">
                        <a href="index.html"><img src="assets/img/brand/logo.png" class="logo-1 logo-color1"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/logo2.png" class="logo-1 logo-color2"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/logo3.png" class="logo-1 logo-color3"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/logo4.png" class="logo-1 logo-color4"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/logo5.png" class="logo-1 logo-color5"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/logo6.png" class="logo-1 logo-color6"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/logo-white.png" class="dark-logo-1"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/favicon.png" class="logo-2 logo-color1"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/favicon2.png" class="logo-2 logo-color2"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/favicon3.png" class="logo-2 logo-color3"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/favicon4.png" class="logo-2 logo-color4"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/favicon5.png" class="logo-2 logo-color5"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/favicon6.png" class="logo-2 logo-color6"
                                alt="logo"></a>
                        <a href="index.html"><img src="assets/img/brand/favicon-white.png" class="dark-logo-2"
                                alt="logo"></a>
                    </div>
                    <div class="app-sidebar__toggle d-md-none" data-toggle="sidebar">
                        <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                        <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
                    </div>
                </div>
                <div class="main-header-right">
                    <div class="nav nav-item  navbar-nav-right ml-auto">
                        <div class="nav-link" id="bs-example-navbar-collapse-1">
                            <form class="navbar-form" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">
                                        <button type="reset" class="btn btn-default">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button type="submit" class="btn btn-default nav-link resp-btn">
                                            <i class="fe fe-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>

                        <div class="main-header-search ml-0 d-sm-none d-none d-lg-block">
                        
                            @php $userDetails=userDetails(); @endphp
                            
                            <?php  if(Auth::user()->role_as=='1'){ ?>
                            <p>Admin balance @if(!empty($userDetails)) {{$userDetails->wallet_amount}}.00 $ @else 0
                                @endif</p>
                            <?php } ?>
                        </div>

                        <div class="dropdown main-profile-menu nav nav-item nav-link">

                            @if(!empty($userDetails))
                            <a class="profile-user d-flex" href="#">
                                @if(!empty($userDetails->image))
                                <img alt="" src="{{url('public/profile/'.$userDetails->image)}}">
                                @else
                                <img alt="" src="{{url('public/noimg.png')}}">
                                @endif
                                <div class="p-text d-none">
                                    <span class="p-name font-weight-bold">{{$userDetails->name}}</span>

                                </div>
                            </a>
                            <div class="dropdown-menu shadow">
                                <div class="main-header-profile header-img">
                                    <div class="main-img-user">
                                        @if(!empty($userDetails->image))
                                        <img alt="" src="{{url('public/profile/'.$userDetails->image)}}">
                                        @else
                                        <img alt="" src="{{url('public/noimg.png')}}">
                                        @endif

                                    </div>
                                    <h6>{{$userDetails->name}}</h6>
                                </div>
                                <a class="dropdown-item" href="{{url('Profile')}}"><i class="far fa-user"></i> My
                                    Profile</a>

                                <a class="dropdown-item" href="{{url('Change-Password')}}"><i
                                        class="fas fa-sliders-h"></i> Change Password</a>
                                <a class="dropdown-item" href="{{url('logout')}}"><i class="fas fa-sign-out-alt"></i>
                                    Sign Out</a>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /main-header -->
        <!-- container -->
        @section('main-content')
        @show

        <!-- Container closed -->

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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


    <script type="text/javascript">
    var APP_URL = {
        !!json_encode(url('/')) !!
    }
    var secure_token = '{{ csrf_token() }}';
    $('#editor').summernote();
    </script>
    <script>
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        const dropZoneElement = inputElement.closest(".drop-zone");

        dropZoneElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(dropZoneElement, inputElement.files[0]);
            }
        });

        dropZoneElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZoneElement.classList.add("drop-zone--over");
        });

        ["dragleave", "dragend"].forEach((type) => {
            dropZoneElement.addEventListener(type, (e) => {
                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        dropZoneElement.addEventListener("drop", (e) => {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
                updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
            }

            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    /**
     * Updates the thumbnail on a drop zone element.
     *
     * @param {HTMLElement} dropZoneElement
     * @param {File} file
     */
    function updateThumbnail(dropZoneElement, file) {
        let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

        // First time - remove the prompt
        if (dropZoneElement.querySelector(".drop-zone__prompt")) {
            dropZoneElement.querySelector(".drop-zone__prompt").remove();
        }

        // First time - there is no thumbnail element, so lets create it
        if (!thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("drop-zone__thumb");
            dropZoneElement.appendChild(thumbnailElement);
        }

        thumbnailElement.dataset.label = file.name;

        // Show thumbnail for image files
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            };
        } else {
            thumbnailElement.style.backgroundImage = null;
        }
    }
    </script>
    <style>
    .drop-zone {
        max-width: 100%;
        height: 200px;
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-family: "Quicksand", sans-serif;
        font-weight: 500;
        font-size: 20px;
        cursor: pointer;
        color: #cccccc;
        border: 4px dashed #009578;
        border-radius: 10px;
    }

    .drop-zone--over {
        border-style: solid;
    }

    .drop-zone__input {
        display: none;
    }

    .drop-zone__thumb {
        width: 100%;
        height: 100%;
        border-radius: 10px;
        overflow: hidden;
        background-color: #cccccc;
        background-size: cover;
        position: relative;
    }

    .drop-zone__thumb::after {
        content: attr(data-label);
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 5px 0;
        color: #ffffff;
        background: rgba(0, 0, 0, 0.75);
        font-size: 14px;
        text-align: center;
    }
    </style>
</body>


</html>