@if(!empty($radius))
<form action="{{url('update-radius/'.$radius->id)}}" method="post">
    @csrf
    <div class="form-group">
        <label for="text">Radius:</label>
        <input type="text" class="form-control" id="radius" name="radius" required="" value="{{$radius->radius}}">
    </div>
    <button class="btn ripple btn-info" type="submit">Submit</button>
    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
</form>

@endif