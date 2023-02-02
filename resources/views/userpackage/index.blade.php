@extends('layout.main')

@section('main-content')

<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0 pd-t-25">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">User Package List</h4>
                    <button class="btn btn-info btn-sm" data-target="#modaldemo1" data-toggle="modal">Add
                        Package</button>
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
								<th class="wd-15p border-bottom-0">Show Packages</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($user)>0)
                            @php $i=0; @endphp
                            @foreach($user as $rows)
                            @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$rows->name}}</td>
                                <td>
									<a href="javascript:void(0);" class="btn btn-success showPackages" data-id="{{$rows->id}}" role="btn">Show Packages</a>
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
                <h6 class="modal-title" id="changeContent">Add Packages</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{url('add-user-package')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="text">Washer :</label>
                        <select class="form-control" id="user_id" name="user_id" required="">
                            <option value="">Select Washer</option>
                            @if(!empty($user))
                            @foreach($user as $rows)
                            <option value="{{$rows->id}}">{{$rows->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="text">Package Price:</label>
                        <input type="text" class="form-control" id="price" name="price" required=""
                            placeholder="Package Name">
                    </div>
                    <div class="form-group">
                        <label for="text">Package Time:</label>
                        <input type="text" class="form-control" id="package_time" name="package_time" required=""
                            placeholder="Package Time">
                    </div>
                    <div class="form-group">
                        <label for="text">Package Type:</label>
                        <input type="text" class="form-control" id="type" name="type" required=""
                            placeholder="Package Type">

                    </div>
                    <div class="form-group">
                        <label for="text">Package Description:</label>
                        <textarea name="description" id="description" class="form-control" required="" type="text"
                            placeholder="Package Description"></textarea>
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
                <h6 class="modal-title" id="changeContent">Edit Package</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="usermodel">

            </div>
        </div>
    </div>
</div>

<div class="modal" id="showPackagesModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="changeContent">Show Package</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="showPackages">

            </div>

        </div>
    </div>
</div>
<!-- row closed -->
@endsection