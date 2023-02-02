@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Wash Type </h4>
									<button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add Wash Type</button>
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
												<th class="wd-15p border-bottom-0">Type</th>
												<th class="wd-15p border-bottom-0">Vehicle Category</th>
												<!--<th class="wd-15p border-bottom-0">Comission</th>-->

												<th class="wd-15p border-bottom-0">Action</th>

											</tr>
										</thead>
										<tbody>
											 @if(count($category)>0)
											@php $i=0; @endphp
											@foreach($category as $rows)
											@php $i++; @endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$rows['category_name']}}</td>
												<td>{{subcategory($rows['category_id'])}}</td>
												
												<td>
												 <div class="dropdown btn-group mt-2 mb-2">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu shadow tx-13">
														
														<a class="dropdown-item" href="javascript:void(0);" onclick="return confirmDeleteEntry('<?php echo encryption($rows['category_id']); ?>','category','category_id');">Delete</a>
														<a class="dropdown-item editDetails" class="editDetails" data-id="{{$rows['category_id']}}" data-url="edit-category" >Edit</a>
														
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
					<!-- Modal effects -->
				<div class="modal" id="modaldemo1">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Add Washer Type</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="{{url('create-category')}}" method="post">
								 @csrf
							<div class="modal-body">
								  <div class="form-group">
								    <label for="text">Vehicle Type:</label>
								    <input type="text" class="form-control" id="category_name" name="category_name" required="" placeholder="Enter Vehicle Type">
								  </div>
								  <!--<div class="form-group">-->
								  <!--  <label for="text">Comission</label>-->
								  <!--  <input type="text" class="form-control" id="comission" name="comission" required="" placeholder="">-->
								  <!--</div>-->
								  <div class="form-group">
								
								    <div class="input-group mb-3">
		                                <label for="text" class="w-100">Vehicle Category:</label>
		                              <input type="text"  id="category_price" class="form-control" placeholder="Enter Vehicle Category">
		                                <div class="input-group-append">
		                                  <span class="input-group-text p-0 border-0 ">
		                                    <button class="btn btn-info plusCat" type="button"><i class="fas fa-plus"></i></button>
		                                  </span>
		                                </div>
		                               <input type="hidden" name="ingredients_input" id="ingredients_input">
		                               </div>
		                               <div class="col-12 mb-4 append">

                           					
                           				</div>
								  </div>
							</div>
							<div class="modal-footer">
								<button class="btn ripple btn-info" type="submit">Submit</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						  </form>
						</div>
					</div>
				</div>

				<div class="modal" id="showusermodel">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title" id="changeContent">Edit Details</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="usermodel">
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- row closed -->
				<style type="text/css">
					.area-label {
					    padding: 3.5px 13px;
					    background-color: #58b856;
					    color: #ffffff;
					    border-radius: .2rem 0 0 .2rem;
					    float: left;
					    font-size: 12px;
					    font-weight: 200;
					}
					.area-label-delete {
					    padding: 2px 7px;
					    background-color: #58b856;
					    float: left;
					    color: #ffffff;
					    border-left: 0.5px solid white;
					    border-radius: 0 .3rem .3rem 0;
					}
				</style>
@endsection