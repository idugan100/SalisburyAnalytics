
<x-header>

<h2 class="bg-black text-center font-bold text-white text-xl">All Courses</h2>

<form class=" mt-3 flex justify-center" action="{{route('courses.index')}}">
    @method('get')
    <input placeholder="COSC-120" class="border-2 p-2 border-black " name ="search" type="text">
    <button class="p-2 border-2 border-black hover:bg-black hover:text-white" type="submit">Search</button>
</form>

@error('search')
    <div class="flex justify-center  text-lg">Please enter your search in the following format: DEPT-123</div>
@enderror

@if(count($courses)==0)
  <p class="flex justify-center text-lg" >We couldn't find that course. Please double check the department code and course number</p>
@else (!empty($courses))
    <div class="flex justify-center" >
    <div class="max-w-3xl p-6">
    @foreach ($courses as $course)
        <div class="p-3">
            <h3 class="text-2xl font-bold   ">{{$course->courseTitle }}</h3>
            <h3 class="text-2xl font-bold ">{{$course->departmentCode . "-" . $course->courseNumber}}</h3>
            <div class="border-b-2 border-black"></div>
            <p class="  m-1 text-md text-md">{{$course->description}}</p>
           
       
        {{--delete button--}}
        <div class="border-b-2 border-black"></div>
        @auth
        <div class="flex">
            <form  class="my-2" method="POST" action="{{ route('courses.destroy', $course->id) }}">
                @csrf
                @method('delete')
                <button class="bg-gray-200 hover:bg-red-900 hover:text-white rounded p-1">Delete</button>
            </form>
            <a class="m-2 bg-gray-200 hover:bg-blue-900 hover:text-white rounded p-1"href="{{route("courses.edit",$course->id)}}">Edit</a>
            @endauth
            <a class="my-2 bg-gray-200 hover:bg-blue-900 hover:text-white rounded p-1"href="{{route("courses.show",$course->id)}}">Reviews</a>
            </div>
        

            
        <hr class="my-2">
        </div>
    @endforeach
    </div>
    </div>
@endif

</x-header>