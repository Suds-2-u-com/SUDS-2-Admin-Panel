@if(!empty($addons))
<?php 
// echo "<pre>";
// print_r($addons[0]->add_ons_name); exit;
?>

<table class="table text-md-nowrap" id="example1">
    <thead>
        <tr>
            <th class="wd-15p border-bottom-0">S.No</th>
            <th class="wd-15p border-bottom-0">Add ONS Name</th>
            <th class="wd-15p border-bottom-0">Add ONS price</th>
            <th class="wd-15p border-bottom-0">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($addons)>0)
        @php $i=0; @endphp
        @foreach($addons as $rows)
        @php $i++; @endphp
        <tr>
            <td>{{$i}}</td>
            <td>@php echo "<pre>"; print_r($rows->add_ons_name); @endphp</td>
            <td>{{$rows->add_ons_price}}</td>
            <td>
                <div class="dropdown btn-group ">
                    <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm"
                        data-toggle="dropdown" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
                    <div class="dropdown-menu shadow tx-13">
                        <a class="dropdown-item" href="javascript:void(0);"
                            onclick="return confirmDeleteEntry('<?php echo encryption($rows->id); ?>','add_ons','id');">Delete</a>
                        <a class="dropdown-item editDetails" data-id="{{$rows->id}}" data-url="edit-addons">Edit</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@else
<p>Data not found</p>
@endif