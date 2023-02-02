@extends('layout.main')

@section('main-content')

<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0 pd-t-25">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Coupon</h4>
                    <button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add
                        Coupon</button>
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
                <div class="alert alert-success">{{\Session::get('success') }}<button data-dismiss="alert" class="close"
                        type="button">x</button>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">S.No</th>
                                <th class="wd-15p border-bottom-0">User Name</th>
                                <th class="wd-15p border-bottom-0">Coupon Name</th>
                                <th class="wd-15p border-bottom-0">Start Date</th>
                                <th class="wd-15p border-bottom-0">End Date</th>
                                <th class="wd-15p border-bottom-0">Amount</th>
                                <th class="wd-15p border-bottom-0">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @if(count($coupon)>0)
                            @php $i=0; @endphp
                            @foreach($coupon as $rows)
                            @php
                            $use= DB::table('users')->where('id',$rows->user_id)->where('role_as', '=', 3)->orderBy('id', 'DESC')->first();
                            @endphp
                            @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>@if(!empty($use)){{$use->name}}@endif</td>
                                <td>{{$rows->coupan_code}}</td>
                                <td>{{$rows->start_date}}</td>
                                <td>{{$rows->end_date}}</td>
                                <td>{{$rows->amount}}</td>
                                <td>
                                    <div class="dropdown btn-group mt-2 mb-2">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                            type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu shadow tx-13">

                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="return confirmDeleteEntry('<?php echo encryption($rows->id); ?>','coupan','id');">Delete</a>
                                            <a class="dropdown-item editCoupon" data-id="{{$rows->id}}"
                                                data-url="edit-city">Edit</a>

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
                <h6 class="modal-title" id="changeContent">Add Coupon</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{url('create-coupon')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="text">User :</label>
                        <select class="form-control" id="user_id" name="user_id">
                            <option value="">Select User</option>
                            @if(!empty($user))
                            @foreach($user as $rows)
                            <option value="{{$rows->id}}">{{$rows->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text">Coupon Code:</label>
                        <input type="text" class="form-control" id="coupan_code" name="coupan_code" required=""
                            placeholder="Enter Coupon Code">
                    </div>
                    <div class="form-group">
                        <label for="text">Amount:</label>
                        <input type="text" class="form-control" id="amount" name="amount" required=""
                            placeholder="Enter Amount">
                    </div>
                    <div class="form-group">
                        <label for="text">Coupon Start Date:</label>
                        <input type="date" class="form-control" date-format="YYYY/MM/DD" id="start_date" name="start_date" required=""
                            placeholder="Enter Start Date">
                    </div>
                    <div class="form-group">
                        <label for="text">Coupon End Date:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required=""
                            placeholder="Enter End Date">
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
                <h6 class="modal-title" id="changeContent">Edit Coupon</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="usermodel">

            </div>

        </div>
    </div>
</div>
<!-- row closed -->

@endsection