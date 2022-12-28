
<x-header>
<h2 class="bg-yellow-500 text-center font-bold text-white font-xl">All Courses</h2>
@foreach ($courses as $course)
    <h3>{{$course->departmentCode . "-" . $course->courseNumber}}</h3>
    <h4>{{$course->creditsTotal . " total credit hours"}}</h4>
    <p>{{$course->description}}</p>
    <a href={{$course->syllabusLink}} target="_blank"> Syllabus</a>
    <p>{{$course->creditsLecture . " hours lecture"}}</p>
    <p>{{$course->creditsLab . " hours lab"}}</p>
    {{--delete button--}}
    <form method="POST" action="{{ route('courses.destroy', $course->id) }}">
        @csrf
        @method('delete')
        <button>delete</button>

    </form>

    <hr>
@endforeach
</x-header>