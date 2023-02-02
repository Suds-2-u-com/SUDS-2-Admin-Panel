@extends('layout.main')

@section('main-content')

<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0 pd-t-25">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Add-ONS List</h4>
                    <button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add
                        ADD-ONS</button>
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
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">S.No</th>
                                <th class="wd-15p border-bottom-0">Vehicle</th>

                                <!-- <th class="wd-15p border-bottom-0">Add ONS Name</th>
												<th class="wd-15p border-bottom-0">Add ONS price</th> -->
                                <th class="wd-15p border-bottom-0">View Add Ons</th>

                                <!-- <th class="wd-15p border-bottom-0">Action</th> -->

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
                                <!-- <td>{{$rows['add_ons_name']}}</td>
												<td>{{$rows['add_ons_price']}}</td> -->
                                <td>
                                    <a href="javascript:void(0);" style="height: auto;"
                                        class="btn-sm btn btn-success view-add-ons"
                                        data-id="{{$rows['category_id']}}">View Add Ons</a>
                                </td>
                                <!-- <td>
                                    <div class="dropdown btn-group ">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                            type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu shadow tx-13">

                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="return confirmDeleteEntry('<?php echo encryption($rows['id']); ?>','add_ons','id');">Delete</a>
                                            <a class="dropdown-item editDetails" data-id="{{$rows['id']}}"
                                                data-url="edit-addons">Edit</a>

                                        </div>
                                    </div>

                                </td> -->

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
                <h6 class="modal-title" id="changeContent">Add Add-ONS</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{url('create-add-ons')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="text">Vehicle:</label>
                        <select name="package_id" id="package_id" required="" class="form-control">
                            <option value="">Select Vehicle</option>
                            @if(!empty($category))
                            @foreach($category as $rows)
                            <option value="{{$rows->category_id}}">{{$rows->category_name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text">Add Ons Name:</label>
                        <input type="text" class="form-control" id="add_ons_name" name="add_ons_name" required=""
                            placeholder="Enter Add Ons Name">
                    </div>
                    <div class="form-group">
                        <label for="text">Add Ons Price:</label>
                        <input type="text" class="form-control" id="add_ons_price" name="add_ons_price" required=""
                            placeholder="Enter Add Ons Price">
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
                <h6 class="modal-title" id="changeContent">Edit Details</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="usermodel">

            </div>

        </div>
    </div>
</div>

<div class="modal" id="viewAddonsModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">View Add Ons</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="view-add-ons-list">

            </div>

        </div>
    </div>
</div>
<!-- row closed -->
@endsection