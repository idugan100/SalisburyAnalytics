<x-header>
    <x-subHeader :title="'grade distribution '.$course->departmentCode . '-' . $course->courseNumber"/>
        <div class="flex justify-center">
     
                {{-- card --}}
                <div class="relative w-3/4 m-4 bg-white rounded-lg shadow ">
                    <div class="flex items-start justify-between p-4 border-b rounded-t ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            {{"Grade Distribution for " . $course->departmentCode ."-" . $course->courseNumber }} 
                        </h3>
                        
                    </div>
                    <div class="p-6 space-y-6">
                        {{-- chart --}}
                        <div class="border border-4 p-2">
                            {{$chart->container()}}
                        </div>


                        <form action="{{route("courses.show",$course)}}">
                            <div class="flex justify-end">
                                <button class="bg-yellow-500 m-2 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded" type="submit">filter</button>
                            </div>
                            
                            {{-- semester filter --}}
                            <h3 class="text-lg mt-3 font-semibold text-gray-900 ">
                                Semesters Taught 
                            </h3>
                            <div class="flex flex-wrap p-2">
                                @foreach ($semesters as $semester_object)
                                    <span class=" m-1 p-1">
                                        <input 
                                                type="radio" 
                                                id="{{$semester_object->semester . $semester_object->year}}" 
                                                value="{{$semester_object->semester .  $semester_object->year}}" 
                                                class="peer sr-only  " 
                                                name='selected_semester'

                                                @if ($prev_semester==$semester_object->semester . $semester_object->year)
                                                    checked
                                                @endif
                                            >
                                        <label  
                                            for="{{$semester_object->semester .  $semester_object->year}}" 
                                            class="   bg-gray-300 rounded p-1">
                                            {{$semester_object->semester . " " .  $semester_object->year}}
                                        </label>
                                    </span>
                                @endforeach
                                <span class=" m-1 p-1">
                                    <input 
                                            type="radio" 
                                            id="all" 
                                            value="" 
                                            class="peer sr-only  " 
                                            name='selected_semester'

                                            @if ($prev_semester=="")
                                                checked
                                            @endif
                                        >
                                    <label  
                                        for="all" 
                                        class="   bg-gray-300 rounded p-1">
                                        All Semesters
                                    </label>
                                </span>
                            </div>

                            {{-- professor filter --}}
                            <h3 class="text-lg font-semibold text-gray-900 ">
                                Taught By
                            </h3>
                            <div class="flex flex-wrap p-2">
                                @foreach ($professors as $professor)
                                    <span class=" m-1 p-1">
                                        <input 
                                                type="radio" 
                                                id="{{$professor->id}}" 
                                                value="{{$professor->id}}" 
                                                class="peer sr-only  " 
                                                name='selected_professor'
                                                @if ($prev_professor==$professor->id)
                                                    checked
                                                @endif
                                            >
                                        <label  
                                            for="{{$professor->id}}" 
                                            class="   bg-gray-300 rounded p-1">
                                            {{$professor->firstName . " " .  $professor->lastName}}
                                        </label>
                                    </span>
                                @endforeach
                                <span class=" m-1 p-1">
                                    <input 
                                            type="radio" 
                                            id="allprof" 
                                            value="" 
                                            class="peer sr-only  " 
                                            name='selected_professor'
                                            @if ($prev_professor=="")
                                                checked
                                            @endif
                                        >
                                    <label  
                                        for="allprof" 
                                        class="   bg-gray-300 rounded p-1">
                                        All Professors
                                    </label>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        <script src="{{$chart->cdn()}}"></script>
        {{$chart->script()}}
        
    </div>
</x-header>