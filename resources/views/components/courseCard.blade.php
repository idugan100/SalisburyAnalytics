<div class="bg-white  contrast-125 p-3 shadow-lg shadow-sky-500 rounded-lg m-4 ">
    <h3 class="text-2xl p-1 bg-zinc-300 px-2 font-bold underline  ">{{$course->courseTitle }}</h3>
    <h3 class="text-2xl px-2 p-1 bg-zinc-300 font-bold underline">{{$course->departmentCode . "-" . $course->courseNumber}}</h3>
    <p class="  m-1 text-md text-md">{{$course->description}}</p>       
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