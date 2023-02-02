<option value="">Select Subcategory</option>
@if(count($sub)>0)
@foreach($sub as $rows)
<option value="{{$rows->subcategory_id}}">{{$rows->subcategory_name}}</option>
@endforeach
@endif