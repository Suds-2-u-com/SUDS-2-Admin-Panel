@extends('layout.main')

@section('main-content')
 <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

										<div class="left-content">
						<h4 class="content-title mb-2">Hi, welcome back!</h4>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Analytics &amp; Monitoring</li>
							</ol>
						</nav>
					</div>
				</div>
				<!-- breadcrumb -->

				
				<div class="row row-sm">
					<div class="col-lg-12">
						<div class="row row-sm">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
								<div class="card">
									<a href="{{url('Booking-List')}}"><div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">Today Wash</h4>
											
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold">{{todaywash()}}</h4>
												
											</div>
											<div class="card-chart bg-primary-transparent brround ml-auto mt-0">
												<i class="typcn typcn-shopping-cart text-primary tx-24"></i>
											</div>
										</div>
										
										
									</div></a>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
								<div class="card">
									<a href="{{url('Washer-List')}}"><div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">Total  Washer</h4>
											
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold">{{totalwash()}}</h4>
											
											</div>
											<div class="card-chart bg-warning-transparent brround ml-auto mt-0">
												<i class="typcn typcn-chart-line-outline text-warning tx-24"></i>
											</div>
										</div>

										
										
									</div></a>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
								<div class="card">
									<a href="{{url('Customer-List')}}"><div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">Total Customer</h4>
											
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1   font-weight-bold">{{totalCustomer()}}</h4>
												
											</div>
											<div class="card-chart bg-info-transparent brround ml-auto mt-0">
												<i class="typcn typcn-group-outline text-info tx-20"></i>
											</div>
										</div>
									
									
									</div></a>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
								<div class="card">
									<a href="{{url('Booking-Transactions')}}"><div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">Total Payment Received</h4>
											
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold">{{totalPaymentReceived()}}</h4>
												
											</div>
											<div class="card-chart bg-danger-transparent brround ml-auto mt-0">
												<i class="typcn typcn-credit-card text-danger tx-24"></i>
											</div>
										</div>
									
										
									</div></a>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
								<div class="card">
									<a href="{{url('Booking-Transactions')}}"><div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">Pending Payment</h4>
											
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold">{{totalPendingPayment()}}</h4>
												
											</div>
											<div class="card-chart bg-danger-transparent brround ml-auto mt-0">
												<i class="typcn typcn-briefcase text-danger tx-24"></i>
											</div>
										</div>
									
										
									</div></a>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
								<div class="card">
									<a href="{{url('Booking-Transactions')}}"><div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">Total Payout</h4>
											
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold">{{totalPayOut()}}</h4>
												
											</div>
											<div class="card-chart bg-danger-transparent brround ml-auto mt-0">
												<i class="typcn typcn-chart-bar-outline text-danger tx-24"></i>
											</div>
										</div>
									
										
									</div></a>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
								<div class="card">
									<a href="{{url('Booking-Transactions')}}"><div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">Total Revenue</h4>
											
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold">{{totalRevenue()}}</h4>
												
											</div>
											<div class="card-chart bg-danger-transparent brround ml-auto mt-0">
												<i class="typcn typcn-briefcase text-danger tx-24"></i>
											</div>
										</div>
									
										
									</div></a>
								</div>
							</div>
							
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
								<div class="card">
									<a href="{{url('Booking-Transactions')}}"><div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">Total On Site Requests</h4>
											
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold">{{totalOnsite()}}</h4>
												
											</div>
											<div class="card-chart bg-danger-transparent brround ml-auto mt-0">
												<i class="typcn typcn-briefcase text-danger tx-24"></i>
											</div>
										</div>
									
										
									</div></a>
								</div>
							</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
								<div class="card">
									<a href="{{url('free_washes')}}"><div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">Total On Free Washes</h4>
											
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold">{{totalOnFreeWashes()}}</h4>
												
											</div>
											<div class="card-chart bg-danger-transparent brround ml-auto mt-0">
												<i class="typcn typcn-briefcase text-danger tx-24"></i>
											</div>
										</div>
									
										
									</div></a>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
				<!-- row close -->


            </div>
@endsection