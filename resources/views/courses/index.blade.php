
<x-header>

<h2 class="bg-yellow-500 text-center font-bold text-white text-xl">All Courses</h2>

<form class="flex justify-center" action="{{route('courses.index')}}">
    @method('get')
    <input placeholder="COSC-120" class="border-2 p-2 border-black " name ="search" type="text">
    <button class="p-2 border-2 border-black hover:bg-black hover:text-white" type="submit">Search</button>
</form>

@error('search')
    <div class="flex justify-center text-red-800 text-lg">Please enter your search in the following format: DEPT-123</div>
@enderror

@if(count($courses)==0)
  <p class="flex justify-center m-3">We couldn't find that course. Please double check the department code and course number</p>
@else (!empty($courses))
    <div class="flex justify-center border" >
    <div class="max-w-3xl p-6">
    @foreach ($courses as $course)
        <div class="p-3">
            <h3 class="text-2xl font-bold underline">{{$course->courseTitle }}</h3>
            <h3 class="text-2xl font-bold underline">{{$course->departmentCode . "-" . $course->courseNumber}}</h3>
            <h4>{{$course->creditsTotal . " total credit hours"}}</h4>
            <p>{{$course->description}}</p>
            <a class="underline text-blue-800"href={{$course->syllabusLink}} target="_blank"> Syllabus</a>
            <p>{{$course->creditsLecture . " hours lecture"}}</p>
            <p>{{$course->creditsLab . " hours lab"}}</p>
        {{--delete button--}}
        @auth
            <form  class="my-2" method="POST" action="{{ route('courses.destroy', $course->id) }}">
                @csrf
                @method('delete')
                <button class="bg-gray-200 hover:bg-red-900 hover:text-white rounded p-1">Delete</button>
            </form>
        @endauth
            
            <hr>
        </div>
    @endforeach
    </div>
    </div>
@endif

</x-header>