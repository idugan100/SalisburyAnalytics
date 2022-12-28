<h1>All Courses</h1>
@foreach ($courses as $course)
    <h3>{{$course->departmentCode . "-" . $course->courseNumber}}</h3>
    <h4>{{$course->creditsTotal . " total credit hours"}}</h4>
    <p>{{$course->description}}</p>
    <a href={{$course->syllabusLink}}> Syllabus</a>
    <p>{{$course->creditsLecture . " hours lecture"}}</p>
    <p>{{$course->creditsLab . " hours lab"}}</p>
    <form method="POST" action="{{ route('courses.destroy', $course->id) }}">
        @csrf
        @method('delete')
        <button>delete</button>

    </form>

    <hr>
@endforeach