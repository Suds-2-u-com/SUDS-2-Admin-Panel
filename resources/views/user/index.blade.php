@extends('layout.main')

@section('main-content')

<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0 pd-t-25">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Washer List</h4>
                    <!--<div>-->
                    <!-- <a class="md-trigger btn btn-info btn-sm add-details" id="send_email" href="javascript:;" data-modal="modal-44">-->
                    <!--                             Send Mail <span class="badge"></span>-->
                    <!--                           </a>-->
                    <!--                           <a class="md-trigger btn btn-info btn-sm add-details" id="send_notification" href="javascript:;" data-modal="modal-444">-->
                    <!--                             Send Notification <span class="badge"></span>-->
                    <!--                           </a>-->
                    <!--                        </div>-->
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
                    <div class="alert alert-success">{{\Session::get('success') }}<button data-dismiss="alert"
                            class="close" type="button">x</button>
                    </div>
                    @endif
                    <form method="post" id="search-form" action="{{url('send_mail_frm')}}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" class="form-control " id="type" value="2">
                        <div class="modal" id="modal-44">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="changeContent">Send Mail To Selected User</h6>
                                        <button aria-label="Close" class="close" data-dismiss="modal"
                                            type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body" id="usermodel">
                                        <div class="col-xs-12">
                                            <div class="row">
                                                <div class="form-group col-sm-4">
                                                    <label
                                                        for="exampleInputEmail1"><b>Subject</b></label>&nbsp;&nbsp;&nbsp;
                                                </div>

                                                <div class="form-group col-sm-8">
                                                    <input type="text" name="subject" class="form-control " id=" "
                                                        placeholder="Enter Subject">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-4">
                                                    <label for="exampleInputEmail1"><b>Message</b></label>
                                                </div>
                                                <div class="form-group col-sm-8">
                                                    <textarea name="message" class="form-control"
                                                        id="editor"></textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="row">-->
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
                                            <input type="submit" id="save" class="btn btn-info btn-lg btn-block"
                                                name="search" value="SEND MAIL" title="SEARCH">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="modal" id="modal-444">-->
                        <!--	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">-->
                        <!--		<div class="modal-content modal-content-demo">-->
                        <!--			<div class="modal-header">-->
                        <!--				<h6 class="modal-title" id="changeContent">Send Notification To Selected Users</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>-->
                        <!--			</div>-->
                        <!--			<div class="modal-body" id="usermodel">-->
                        <!--				<div class="col-xs-12">-->

                        <!--                             <div class="row">-->
                        <!--                              <div class="form-group col-sm-4">-->
                        <!--                                 <label for="exampleInputEmail1"><b>Message</b></label>-->
                        <!--                               </div>-->
                        <!--                                <div class="form-group col-sm-8">  -->
                        <!--                                 <textarea name="notification_message" class="form-control" id="notification_message"></textarea>-->
                        <!--                                 </div>-->
                        <!--                              </div>-->

                        <!--                            <div class="clearfix"></div>-->
                        <!--			</div>-->
                        <!--			  <div class="modal-footer">-->

                        <!--                              <div class="col-md-4 col-md-offset-4">-->
                        <!--                              <input type="submit" id="save" class="btn btn-info btn-lg btn-block" name="notification" value="SEND MAIL" title="SEARCH">-->

                        <!--                              </div>-->
                        <!--                           </div>-->
                        <!--		</div>-->
                        <!--	</div>-->
                        <!--</div>  -->
                        <!--</div>-->


                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <!--<th class=" border-bottom-0"><input type="checkbox" onchange="checkAll(this);" name="chkall" id="chkall" style="cursor:pointer;" class="mt-0"></th>-->
                                    <th class=" border-bottom-0">S.No</th>
                                    <th class=" border-bottom-0">Full Name</th>
                                    <th class=" border-bottom-0">Email</th>

                                    <th class=" border-bottom-0">Wallet</th>
                                    <th class=" border-bottom-0">Account Id</th>
                                    <th class=" border-bottom-0">Status</th>

                                    <th class=" border-bottom-0">Document</th>

                                    <th class=" border-bottom-0">Background Check</th>
                                    <th class=" border-bottom-0">Vehicle Insurance</th>
                                    <th class=" border-bottom-0">Vehicle Registraion</th>
                                    
                                    <th class=" border-bottom-0">Document Expired</th>

                                    <th class=" border-bottom-0">Bank Info</th>
                                    <th class=" border-bottom-0">Review List</th>
                                    <th class=" border-bottom-0">Payout create</th>
                                    <!--<th class=" border-bottom-0">Payout</th>-->
                                    <th class=" border-bottom-0">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($user))
                                @php $i=0; @endphp
                                @foreach($user as $rows)
                                @php $i++ @endphp
                                <tr>
                                    <!--<td><input type="checkbox" name="action_id[]" id="action_id" value="{{$rows['id']}}"></td>-->
                                    <td>{{$i}}</td>
                                    <td>{{$rows['name']}}</td>
                                    <td>{{$rows['email']}}</td>

                                    <td>@if(!empty($rows['wallet_amount'])) {{$rows['wallet_amount']}}.00 ₹ @else 0
                                        @endif</td>
                                    <td>{{$rows['washer_accountid']}}</td>
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
                                    <td>
                                        @php $discount=discount($rows['id']);
                                        $bankinfo=bank($rows['id']);
                                        $review=review($rows['id']);

                                        @endphp

                                        @if(!empty($discount))
                                        <a href="javascript:void(0);" style="height: auto;"
                                            class="showDoc btn btn-success btn-sm " data-id="{{$rows['id']}}">View
                                            Document</a>
                                        @else
                                        <a href="javascript:void(0);" style="height: auto;"
                                            class="showDoc btn btn-danger  btn-sm " data-id="{{$rows['id']}}">View
                                            Document</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($rows['background_check'] == 0) 
                                        <a style="height: auto;" class="btn btn-danger btn-sm shoebackgroundcheck" href="javascript:void(0);"
                                            data-id="{{$rows['id']}}">View Background Check</a>
                                        @else
                                        <a style="height: auto;" class="btn btn-success btn-sm shoebackgroundcheck" href="javascript:void(0);"
                                            data-id="{{$rows['id']}}">View Background Check</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($rows['background_check'] == 0) 
                                        <a style="height: auto;" class="btn btn-danger btn-sm VehicleInsurance" href="javascript:void(0);"
                                            data-id="{{$rows['id']}}">View Vehicle Insurance</a>
                                        @else
                                        <a style="height: auto;" class="btn btn-success btn-sm VehicleInsurance" href="javascript:void(0);"
                                            data-id="{{$rows['id']}}">View Vehicle Insurance</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($rows['background_check'] == 0) 
                                        <a style="height: auto;" class="btn btn-danger   btn-sm VehicleRegistration" href="javascript:void(0);"
                                        data-id="{{$rows['id']}}">View Vehicle Registration</a>
                                        @else
                                        <a style="height: auto;" class="btn btn-success btn-sm VehicleRegistration" href="javascript:void(0);"
                                            data-id="{{$rows['id']}}">View Vehicle Registration</a>
                                        @endif
                                    </td>

                                    <td>
                                        @if($rows['expired_vehicle_insurance'] == 1 || $rows['expired_vehicle_registeration'] == 1 || $rows['expired_user_license'] == 1) 
                                            <a style="height: auto;" class="btn btn-danger btn-sm" href="javascript:void(0);">Expired</a>
                                        @else
                                            <a style="height: auto;" class="btn btn-success btn-sm" href="javascript:void(0);">Not Expired</a>
                                        @endif
                                    </td>

                                    <td>
                                        @if(!empty($bankinfo))
                                        <a href="javascript:void(0);" style="height: auto;"
                                            class="showBankDetails btn btn-success btn-sm "
                                            data-id="{{$rows['id']}}">View Bank Info</a>
                                        @else
                                        <a href="javascript:void(0);" style="height: auto;"
                                            class="showBankDetails btn btn-danger btn-sm "
                                            data-id="{{$rows['id']}}">View Bank Info</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($review)>0)
                                        <a href='{{url("WasherReviewlist/$rows->id")}}' class="btn btn-success  btn-sm "
                                            style="height: auto;">View Review</a>
                                        @else
                                        <a href='{{url("WasherReviewlist/$rows->id")}}' class="btn btn-danger  btn-sm "
                                            style="height: auto;">View Review</a>

                                        @endif
                                    </td>
                                     <td>
                                        <a href="javascript:void(0);" class="btn btn-info  btn-sm showpayoutcreate"
                                            data-id="{{$rows['id']}}" style="height: auto;">Pay Out create</a>
                                    </td>
                                    <!--<td>
                                        <a href="javascript:void(0);" class="btn btn-info  btn-sm showpayout"
                                            data-id="{{$rows['id']}}" style="height: auto;">Pay Out</a>
                                    </td>-->

                                    <td>
                                        <div class="dropdown btn-group ">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn btn-sm ripple btn-primary" data-toggle="dropdown"
                                                type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
                                            <div class="dropdown-menu shadow tx-13">
                                                <a class="dropdown-item editwasher" href="javascript:void(0);" data-id="{{$rows['id']}}"  >Edit</a>
                                                @if($rows['status']==0)
                                                <a class="dropdown-item chnagestatusnew" href="javascript:void(0);"
                                                    data-id="{{$rows['id']}}" data-status="1">Disapproved</a>
                                                @else
                                                <a class="dropdown-item chnagestatusnew" href="javascript:void(0); "
                                                    data-id="{{$rows['id']}}" data-status="0">Approved</a>
                                                @endif
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="return confirmDelete('<?php echo encryption($rows['id']); ?>');">Delete</a>
                                                <a class="dropdown-item showbasicDetails" href="javascript:void(0);"
                                                    data-id="{{$rows['id']}}">View Profile</a>
                                                <a class="dropdown-item showpersentage" href="javascript:void(0);"
                                                    data-id="{{$rows['id']}}">Percentage Adjustable</a>
                                                <!-- <a class="dropdown-item shoebackgroundcheck" href="javascript:void(0);"
                                                    data-id="{{$rows['id']}}">Background Check</a>
                                                <a class="dropdown-item VehicleInsurance" href="javascript:void(0);"
                                                    data-id="{{$rows['id']}}">Vehicle Insurance</a>
                                                <a class="dropdown-item VehicleRegistration" href="javascript:void(0);"
                                                    data-id="{{$rows['id']}}">Vehicle Registraion</a> -->
                                            </div>
                                        </div>
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

<div class="modal" id="showBackgroundodel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">View Background</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="showbackground">

            </div>
            <!-- <div class="modal-footer">

                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div> -->
        </div>
    </div>
</div>

<div class="modal" id="VehicleInsuranceshow">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">View Vehicle Insurance</h6><button aria-label="Close"
                    class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="VehicleInsuranceid">

            </div>
            <!-- <div class="modal-footer">

                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div> -->
        </div>
    </div>
</div>


<div class="modal" id="Vehicleregistrationshow">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">View Vehicle Registration</h6><button aria-label="Close"
                    class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="Vehicleregisid">

            </div>
            <!-- <div class="modal-footer">

                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div> -->
        </div>
    </div>
</div>

<!-- Modal effects -->
<div class="modal" id="showusermodel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">View All Details</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="usermodels1">

            </div>
            <div class="modal-footer">

                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="docmodel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">Document Details</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="userdocmodel">

            </div>

        </div>
    </div>
</div>
<div class="modal" id="docmodelper">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">Set Persentage</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="userdocmodelper">

            </div>

        </div>
    </div>
</div>

<div class="modal" id="payoutmodel">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">Payout Details</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="paymentmodel">

            </div>

        </div>
    </div>
</div>

<div class="modal" id="payoutcreatemodel">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">Payout Details</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="paymentcreatemodel">

            </div>

        </div>
    </div>
</div>
<!-- row closed -->
@endsection