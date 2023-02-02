@extends('layout.main')

@section('main-content')

<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0 pd-t-25">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Washer Earning List</h4>
                    <!-- <button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add Package</button> -->
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
                                <th class="wd-15p border-bottom-0">Washer Name</th>
                                <th class="wd-15p border-bottom-0">Booking Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($user))
                            @php $i=0; @endphp
                            @foreach($user as $rows)
                            @php $i++ @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$rows->name}}</td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-success showBookingDetails" data-id="{{$rows->id}}" role="btn">Show Booking Details</a>
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
<div class="modal" id="showbookingDetailsModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">Show Booking Details</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="showbookingDetails">

            </div>
            <div class="modal-footer">

                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection