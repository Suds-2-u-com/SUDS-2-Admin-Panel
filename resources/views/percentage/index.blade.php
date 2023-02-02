@extends('layout.main')

@section('main-content')

<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Percentage</h4>
									<button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add Package</button>
								</div>
								
							</div>
							<div class="card-body">
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
							
								<form action="{{url('add-percentage')}}" method="post">
								 @csrf
								 
                                <div class="form-group">
                                        <label for="code">Vendor percentage<span class="required">*</span></label>
                                        <div class="input-group">
                                              <input type="text" class="form-control" id="vendor_percentage" name="vendor_percentage" required="" placeholder="Vendor Percentage" value="@if(!empty($percentage)) {{$percentage->vendor_percentage}} @endif">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary"  title="" data-original-title="Percentage" >%</button>
                                            </div>
                                        </div>
                                </div>
                                  <div class="form-group">
                                        <label for="code">Admin percentage<span class="required">*</span></label>
                                        <div class="input-group">
                                              <input type="text" class="form-control" id="admin_percentage" name="admin_percentage" required="" placeholder="Admin Percentage" value="@if(!empty($percentage)) {{$percentage->admin_percentage}} @endif">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary"  title="" data-original-title="Percentage" >%</button>
                                            </div>
                                        </div>
                                </div>
								
							
								  <button class="btn btn-info" type="submit" >Update</button>
								  </form>
						    </div>
					</div>
					
				</div>
			
			
@endsection