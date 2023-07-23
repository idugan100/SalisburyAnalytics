<div class="  contrast-125 group p-3 shadow-lg  shadow-black  bg-white hover:bg-red-700 rounded-lg m-2 p-5 ">
    <h3 class=" text-2xl py-1 px-2 font-bold ">{{$course->courseTitle}}</h3>
    <hr class="border-1 border-yellow-500 ">

    <h4 class="text-md   py-1 px-2  m-2 group-hover:text-gray-300 font-bold">{{$course->departmentCode . "-" . $course->courseNumber}}</h4>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Avergage GPA: " . $course->avg_gpa}}</div>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Total Enrollment: " . $course->qty_A + $course->qty_B + $course->qty_B + $course->qty_C + $course->qty_D + $course->qty_F + $course->qty_W}}</div>
    <div class="px-2 py-1 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Number of Reviews: " . count($course->reviews)}}</div>
    @if ($course->description!=null)
    <div class="px-2 py-1 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{$course->description}}</div>
    @endif

    <div class="flex rounded-md">
        @auth
            <form  class="" method="POST" action="{{ route('courses.destroy', $course->id) }}">
                @csrf
                @method('delete')
                <button class="m-2  border-4 border-yellow-500 hover:text-gray-300 bg-yellow-500 rounded font-bold px-1">delete</button>
            </form>     
            <a class="m-2  border-4 border-yellow-500 hover:text-gray-300 bg-yellow-500 rounded font-bold px-1" href="{{route('courses.edit',$course->id)}}">edit</a>
        @endauth
        <a class="m-2  border-4 border-yellow-500 hover:text-gray-300 bg-yellow-500 rounded font-bold px-1" href="{{route('courses.show',$course->id)}}">reviews</a>
        <button data-modal-target="{{"Course-Modal-".$course->id}}" data-modal-toggle="{{"Course-Modal-".$course->id}}" class="m-2  border-4 border-yellow-500 hover:text-gray-300 bg-yellow-500 rounded font-bold px-1" type="button">charts</button>
    </div>
</div>  


<!-- Modal content -->
<div id="{{"Course-Modal-".$course->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <livewire:course-grade-distribution-card :course="$course"/>
</div>
