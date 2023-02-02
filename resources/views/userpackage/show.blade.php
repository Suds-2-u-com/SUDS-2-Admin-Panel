@if(!empty($packages))
<table class="table mg-b-0 text-md-nowrap border">
    <thead>
        <tr>
            <th class="wd-15p border-bottom-0">S.No</th>
            <th class="wd-15p border-bottom-0">Package Type</th>
            <th class="wd-15p border-bottom-0">Package Time</th>
            <th class="wd-15p border-bottom-0">Package Price</th>
            <th class="wd-15p border-bottom-0">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($packages) && count($packages) > 0)
        @php $i=0; @endphp
        @foreach($packages as $rows)
        @php $i++ @endphp
        <tr>
            <td>{{$i}}</td>
            <td>{{$rows->type}}</td>
            <td>{{$rows->package_time}}</td>
            <td>{{$rows->price}}</td>
            <td>
                <div class="dropdown btn-group mt-2 mb-2">
                    <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm"
                        data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
                    <div class="dropdown-menu shadow tx-13">
                        <a class="dropdown-item" href="javascript:void(0);"
                            onclick="return confirmDeleteEntry('<?php echo encryption($rows->id); ?>','user_packages','id');">Delete</a>
                        <a class="dropdown-item editUserPackage" data-id="{{$rows->id}}"
                            data-url="edit-package">Edit</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="4">No data found!</td>
        </tr>
        @endif
    </tbody>
</table>
@else
<p>Not available</p>
@endif