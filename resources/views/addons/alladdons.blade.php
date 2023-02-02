<div class="row">
@if(count($addons)>0)
@foreach($addons as $rows)
<!-- <div class="col-lg-3">
	<label class="checkbox"><input type="checkbox" value="{{$rows->id}}" name="add_ons[]" ><span>{{$rows->add_ons_name}}</span></label>
</div> -->



			<div class="col-md-4 mg-t-20 mg-lg-t-0">
				<label class="ckbox"><input type="checkbox" value="{{$rows->id}}" name="add_ons[]" ><span>{{ucfirst($rows->add_ons_name)}}</span>
				</label>
		    </div>	
		    <br>						
		
@endforeach
@endif
</div>