
<option value="" >select professor</option>

@foreach ($professors as $professor)
    <option value="{{$professor->id}}">{{$professor->firstName . " " . $professor->lastName}}</option>
@endforeach



