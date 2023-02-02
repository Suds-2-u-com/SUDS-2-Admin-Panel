@if(!empty($city))
@foreach($city as $rows)
<option value="{{$rows['id']}}">{{$rows['name']}}</option>
@endforeach
@endif