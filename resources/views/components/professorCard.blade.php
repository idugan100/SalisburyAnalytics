<div class=" contrast-125 group shadow-lg shadow-black bg-white hover:{{env("ACCENT_BG")}} rounded-lg m-2 p-5 ">
    <h3 class=" text-2xl py-1 px-2 font-bold group-hover:text-gray-300 ">{{$professor->firstName . " " . $professor->lastName }}</h3>
    <hr class="border-1 {{env("MAIN_BORDER")}} ">

    <h4 class="text-md   py-1 px-2  m-2 group-hover:text-gray-300 font-bold">{{$professor->department}}</h4>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Average GPA: " . $professor->avg_gpa}}</div>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Withdraw Rate: " . ($professor->W_rate ?? "0") . "%"}}</div>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Students Taught: " . $professor->total_enrollment}}</div>
    <div class="px-2 py-1 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Number of Reviews: " . count($professor->reviews)}}</div>

    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> <span>Frequently Teaches: </span>
        <ul class="list-disc py-1 px-2 m-2">
            @foreach ($professor->topCourses as $top_course)
                <li>
                    {{$top_course->courseTitle . " (".$top_course->departmentCode ."-".$top_course->courseNumber .")"}}
                </li> 
            @endforeach
        </ul>
                    
    </div>

    <div class="flex flex-wrap rounded-md">
        @auth
            @if (auth()->user()->email == env("ADMIN_EMAIL"))
                <form  class="" method="POST" action="{{ route('professors.destroy', $professor->id) }}" onsubmit="return confirm('Do you really want to delete this? You will be unable to get this professor back.');">
                    @csrf
                    @method('delete')
                    <button class="m-2  border-4 {{env("MAIN_BORDER")}} hover:text-gray-300 {{env("MAIN_BG")}} rounded font-bold px-1">delete</button>
                </form>     
                <a class="m-2  border-4 {{env("MAIN_BORDER")}} hover:text-gray-300 {{env("MAIN_BG")}} rounded font-bold px-1" href="{{route('professors.edit',$professor->id)}}">edit</a>
            @endif
        @endauth
        <button data-modal-target="{{"Rmp-Modal-".$professor->id}}" data-modal-toggle="{{"Rmp-Modal-".$professor->id}}" class="m-2  border-4 {{env("MAIN_BORDER")}} hover:text-gray-300 {{env("MAIN_BG")}} rounded font-bold px-1" type="button">rate my professor</button>
        <button data-modal-target="{{"Review-Modal-".$professor->id}}" data-modal-toggle="{{"Review-Modal-".$professor->id}}" class="m-2  border-4 {{env("MAIN_BORDER")}} hover:text-gray-300 {{env("MAIN_BG")}} rounded font-bold px-1" type="button">reviews</button>
        <a class="m-2  border-4 {{env("MAIN_BORDER")}} hover:text-gray-300 {{env("MAIN_BG")}} rounded font-bold px-1" href="{{route('professors.show',$professor->id)}}">grades</a>
    </div>
</div>   

<!-- Review Modal content -->
<div id="{{"Review-Modal-".$professor->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full h-full max-w-2xl max-h-full">
        
        <div class="mt-8 relative bg-gray-300 rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t {{env("ACCENT_BORDER")}}">
                <h3 class="text-xl font-semibold text-gray-900 ">
                    {{"Reviews for " . $professor->firstName ." " . $professor->lastName }} 
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center " data-modal-hide={{"Review-Modal-".$professor->id}}>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="flex justify-end">
                    <a href="{{route("reviews.create")}}" class="m-2  border-4 {{env("MAIN_BORDER")}} hover:text-gray-300 {{env("MAIN_BG")}} rounded font-bold px-1">+ add</a>
                </div>

                    @if (count($professor->reviews)==0)
                    <div class="flex justify-center col-start-2  text-lg">Sorry, no reviews found for this professor :(</div>
                    @endif
                    <div class="col-start-2 col-span-2 mt-4">
                        @foreach ($professor->reviews as $review)
                                <x-reviewCard :review="$review"></x-reviewCard>   
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</div>

<!-- RMP Modal content -->
<div id="{{"Rmp-Modal-".$professor->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden h-full w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
    <div class="relative w-full h-full max-w-2xl max-h-full">
        
        <div class="relative bg-gray-300 rounded-lg shadow mt-8 ">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t {{env("ACCENT_BORDER")}}">
                <h3 class="text-xl font-semibold text-gray-900 ">
                    {{"Rate My Professor for " . $professor->firstName ." " . $professor->lastName }} 
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center " data-modal-hide={{"Rmp-Modal-".$professor->id}}>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="flex justify-end">
                <a href="{{route("reviews.create")}}" class="m-2  border-4 {{env("MAIN_BORDER")}} hover:text-gray-300 {{env("MAIN_BG")}} rounded font-bold px-1">+ add review</a>
            </div>
            <div class="p-6 space-y-6 flex justify-center ">

                @if (isset($professor->rmp_link))
                    <iframe loading="lazy" src="{{$professor->rmp_link}}" sandbox height="450" width="600"></iframe>

                @else
                    <p>this professor does not have a rate my professor page :(</p>
                @endif
            </div>
            
        </div>
    </div>
</div>
