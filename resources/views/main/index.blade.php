
@extends('layout.main')

@section('main-content')

				<div class="row">
					<div class="col-lg-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0 pd-t-25">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Mail List </h4>
									<div>
 <a class="md-trigger btn btn-info btn-sm add-details" id="send_emails" href="javascript:;" data-modal="modal-44">
      Send Mail <span class="badge"></span>
   </a>
   <a class="md-trigger btn btn-info btn-sm add-details" id="send_notification" href="javascript:;" data-modal="modal-444">
                                      Send Notification <span class="badge"></span>
                                   </a>
                                   </div>
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
								    <form method="post" id="search-form" action="{{url('send_mail_frm')}}" enctype="multipart/form-data" >
								         @csrf
								         <input type="hidden" name="type" class="form-control " id="type" value="3" >  
								   <div class="modal" id="modal-44">
                    					<div class="modal-dialog modal-dialog-centered modal-lg"  role="document">
                    						<div class="modal-content modal-content-demo">
                    							<div class="modal-header">
                    								<h6 class="modal-title" id="changeContent">Send Mail</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    							</div>
                    							<div class="modal-body" id="usermodel">
                    								<div class="col-xs-12">
                    							   
                    							    <div class="row">
                    								      <div class="form-group col-sm-4">
                                                         <label  for="exampleInputEmail1"><b>Select Option</b></label>&nbsp;&nbsp;&nbsp;
                                                         </div>
                                                         <div class="form-group col-sm-8">
                                                         <select name="types" id="types" class="form-control" required>
                                                             <option value="">Select Option</option>
                                                             <option value="all">All</option>
                                                             <option value="all_user">All User</option>
                                                             <option value="all_washer">All Washer</option>
                                                         </select>
                                                         </div>
                                                      </div>
                    							
                    							   
                    							   
                                                     <div class="row">
                                                      <div class="form-group col-sm-4">
                                                         <label  for="exampleInputEmail1"><b>Subject</b></label>&nbsp;&nbsp;&nbsp;
                                                      </div>
                                
                                                       <div class="form-group col-sm-8">
                                                         <input type="text" name="subject" class="form-control " id=" " placeholder="Enter Subject" >  
                                                      </div>
                                                    </div>
                                                     <div class="row">
                                                      <div class="form-group col-sm-4">
                                                         <label for="exampleInputEmail1"><b>Message</b></label>
                                                       </div>
                                                        <div class="form-group col-sm-8">  
                                                         <textarea name="message" class="form-control" id="editor"></textarea>
                                                         </div>
                                                      </div>
                                                      
                                                      <!--  <div class="row">-->
                                                      <!--<div class="form-group col-sm-4">-->
                                                      <!--   <label for="exampleInputEmail1"><b>Attachment</b></label>-->
                                                      <!-- </div>-->
                                                      <!--  <div class="form-group col-sm-8">  -->
                                                      <!--  <input type="file" name="file" class="form-control " id="file">  -->
                                                      <!--   </div>-->
                                                      <!--</div>-->
                                                         <div class="drop-zone">
                                                            <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                            <input type="file" name="file" class="drop-zone__input">
                                                          </div>
                                                      
                                                     </div>
                                                    <div class="clearfix"></div>
                    							</div>
                    							  <div class="modal-footer">
                                            
                                                      <div class="col-md-4 col-md-offset-4">
                                                      <input type="submit" id="save" class="btn btn-info btn-lg btn-block" name="search" value="SEND MAIL" title="SEARCH">
                                                     
                                                      </div>
                                                   </div>
                    						</div>
                    					</div>
                    				</div>     
                    				
                    					 <div class="modal" id="modal-444">
                    					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    						<div class="modal-content modal-content-demo">
                    							<div class="modal-header">
                    								<h6 class="modal-title" id="changeContent">Send Notification To Selected Users</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    							</div>
                    							<div class="modal-body" id="usermodel">
                    								<div class="col-xs-12">
                                                    
                                                     <div class="row">
                                                      <div class="form-group col-sm-4">
                                                         <label for="exampleInputEmail1"><b>Message</b></label>
                                                       </div>
                                                        <div class="form-group col-sm-8">  
                                                         <textarea name="notification_message" class="form-control" id="notification_message"></textarea>
                                                         </div>
                                                      </div>
                                                      
                                                    <div class="clearfix"></div>
                    							</div>
                    							  <div class="modal-footer">
                                            
                                                      <div class="col-md-4 col-md-offset-4">
                                                      <input type="submit" id="save" class="btn btn-info btn-lg btn-block" name="notification" value="SEND MAIL" title="SEARCH">
                                                     
                                                      </div>
                                                   </div>
                    						</div>
                    					</div>
                    				</div>  
                    				</div>
								    
		
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
											    <!--<th class=" border-bottom-0"><input type="checkbox" onchange="checkAll(this);" name="chkall" id="chkall" style="cursor:pointer;" class="mt-0"></th>-->
												<th class=" border-bottom-0">S.No</th>
												<th class=" border-bottom-0">Full Name</th>
												<th class=" border-bottom-0">Email Address</th>
												<th class="border-bottom-0">City</th>
												<th class=" border-bottom-0">Phone Number</th>
												<th class=" border-bottom-0">Status</th>
											</tr>
										</thead>
										<tbody>
											@if(!empty($user))
											@php $i=0; @endphp
											@foreach($user as $rows)
											@php $i++ @endphp
											<tr>
											    <!--<td> <input type="checkbox" name="action_id[]" id="action_id" value="{{$rows['id']}}"> </td>-->
												<td>{{$i}}</td>
												<td>{{$rows['name']}}</td>
											    <td>{{$rows['email']}}</td>
												<td>{{city(cityUserid($rows['id']))}}</td>
												<td>{{$rows['mobile']}}</td>
												<td>@if($rows['status']==0)
													<!-- <a href="javascript:void(0);" data-id="{{$rows['id']}}" data-status="1" class="badge badge-danger "> -->
													In-Active
												    <!-- </a> -->
													@else
													<!-- <a href="javascript:void(0); " data-id="{{$rows['id']}}" data-status="0" class="badge badge-success "> -->
													Active
												   <!--  </a> -->
													@endif
													</td>
											
											
											
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">

					</div>
				</div>

				
		 
@endsection