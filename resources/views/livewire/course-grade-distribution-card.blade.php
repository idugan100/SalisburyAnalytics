<div class="relative w-full max-w-2xl max-h-full">
        
    <div class="relative bg-white rounded-lg shadow ">
        <!-- Modal header -->
        <div class="flex items-start justify-between p-4 border-b rounded-t ">
            <h3 class="text-xl font-semibold text-gray-900 ">
                {{"Grade Distribution for " . $course->departmentCode ."-" . $course->courseNumber }} 
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center " data-modal-hide={{"Course-Modal-".$course->id}}>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6">
            {{$chart->container()}}
            <h3 class="text-lg font-semibold text-gray-900 ">
                Semesters Taught 
            </h3>
            <div class="flex flex-wrap">
                @foreach ($semesters as $semester_object)
                    <span class="  m-1  p-1">
                        <input 
                                type="radio" 
                                id="{{$semester_object["semester"] . $semester_object["year"]}}" 
                                value="{{$semester_object["semester"] .  $semester_object["year"]}}" 
                                class="peer sr-only  " 
                                name='selected_semester'
                                wire:model="selected_semester"
                            >
                        <label  
                            for="{{$semester_object["semester"] .  $semester_object["year"]}}" 
                            class="   bg-gray-300 rounded p-1">
                            {{$semester_object["semester"] . " " .  $semester_object["year"]}}
                        </label>
                    </span>
                @endforeach
            </div>
            <h3 class="text-lg font-semibold text-gray-900 ">
                Frequently Taught By
            </h3>
            <div class="flex flex-wrap p-2">
                @foreach ($topProfessors as $top_professor)
                    <a href="{{route("professors.index",[ 'department' => $course->departmentCode,"professor_id"=>$top_professor["id"]])}}" class="py-1 px-2 m-1 rounded-full text-sm bg-gray-200 hover:bg-gray-300 hover:drop-shadow-md duration-300">
                        {{$top_professor["firstName"] . " " . $top_professor["lastName"]}}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <script src="{{$chart->cdn()}}"></script>
{{$chart->script()}}
</div>
