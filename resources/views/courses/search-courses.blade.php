<option value="" >select course</option>

@foreach ($courses as $course)
    <option value="{{$course->courseNumber}}">{{$course->courseNumber . " - " . $course->courseTitle}}</option>
@endforeach


