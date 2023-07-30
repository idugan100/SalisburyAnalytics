<div class="  contrast-125 group p-3 shadow-lg  shadow-black  bg-white hover:bg-red-700 rounded-lg m-2 p-5 ">
    <h3 class=" text-2xl py-1 px-2 font-bold ">{{$course->courseTitle}}</h3>
    <hr class="border-1 border-yellow-500 ">

    <h4 class="text-md   py-1 px-2  m-2 group-hover:text-gray-300 font-bold">{{$course->departmentCode . "-" . $course->courseNumber}}</h4>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Average GPA: " . $course->avg_gpa}}</div>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Withdraw Rate: " . ($course->withdraw_pct ?? "0") . "%"}}</div>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Total Enrollment: " .  $course->total_enrollment}}</div>
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
        <button data-modal-target="{{"Review-Modal-".$course->id}}" data-modal-toggle="{{"Review-Modal-".$course->id}}" class="m-2  border-4 border-yellow-500 hover:text-gray-300 bg-yellow-500 rounded font-bold px-1" type="button">reviews</button>
        <a class="m-2  border-4 border-yellow-500 hover:text-gray-300 bg-yellow-500 rounded font-bold px-1" href="{{route('courses.show',$course->id)}}">grades</a>
    </div>
</div>  


<!-- Modal content -->
<div id="{{"Review-Modal-".$course->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        
        <div class="relative bg-gray-300 rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t ">
                <h3 class="text-xl font-semibold text-gray-900 ">
                    {{"Reviews for " . $course->departmentCode ."-" . $course->courseNumber }} 
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center " data-modal-hide={{"Review-Modal-".$course->id}}>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="flex justify-end">
                    <a href="{{route("reviews.create")}}" class="m-2  border-4 border-yellow-500 hover:text-gray-300 bg-yellow-500 rounded font-bold px-1">add +</a>
                </div>

                    @if (count($course->reviews)==0)
                    <div class="flex justify-center col-start-2  text-lg">Sorry, no reviews found for this course :(</div>
                    @endif
                    <div class="col-start-2 col-span-2 mt-4">
                        @foreach ($course->reviews as $review)
                                <x-reviewCard :review="$review"></x-reviewCard>   
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</div>
