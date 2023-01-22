
<x-header>

<h2 class="bg-black text-center font-bold text-white text-2xl">all courses</h2>

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
        <div class="bg-white  contrast-125 p-3 shadow-lg shadow-sky-500 rounded-lg m-4 ">
            <h3 class="text-2xl p-1 bg-zinc-300 px-2 font-bold underline  ">{{$course->courseTitle }}</h3>
            <h3 class="text-2xl px-2 p-1 bg-zinc-300 font-bold underline">{{$course->departmentCode . "-" . $course->courseNumber}}</h3>
            <p class="  m-1 text-md text-md">{{$course->description}}</p>       
        {{--delete button--}}

            <div class="flex  rounded-md">
            @auth
                <form  class="" method="POST" action="{{ route('courses.destroy', $course->id) }}">
                    @csrf
                    @method('delete')
                    <button class="m-1  border-2 border-sky-500 hover:text-white hover:bg-sky-500 rounded px-1">Delete</button>
                </form>
                <a class="m-1  border-2 border-sky-500 hover:text-white hover:bg-sky-500 rounded px-1"href="{{route("courses.edit",$course->id)}}">Edit</a>
            @endauth
            <a class="m-1  border-2 border-sky-500 hover:text-white hover:bg-sky-500 rounded px-1"href="{{route("courses.show",$course->id)}}">Reviews</a>
        </div>            
        </div>
    @endforeach
    </div>
    </div>
@endif

</x-header>