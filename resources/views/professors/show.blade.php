<x-header>
    <x-subHeader :title="'grade distribution for '.$professor->firstName . ' ' . $professor->lastName"/>   
        <div class="flex justify-center">
     
            {{-- card --}}
            <div class="relative w-3/4 m-4 bg-white rounded-lg shadow ">
                <div class="flex items-start justify-between p-4 border-b rounded-t ">
                    <h3 class="text-xl font-semibold text-gray-900 ">
                        {{"Grade Distribution for " . $professor->firstName ." " . $professor->lastName }} 
                    </h3>
                    
                </div>
                <div class="p-6 space-y-6">
                    {{-- chart --}}
                    <div class="border border-4 p-2 " style="height: 300px;">
                        <div  id="chart" >
                            {{$chart->container()}}
                            <script src="{{$chart->cdn()}}"></script>
                            {{$chart->script()}}
                        </div>
                    </div>
                   


                    <form action="{{route("professors.show",$professor)}}">
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
                                            hx-get="{{route("professors.show",$professor)}}" 
                                            hx-target="#chart"
                                            hx-select="#chart"
                                            hx-include="form"
                                            hx-swap="outerHTML"
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
                                        hx-get="{{route("professors.show",$professor)}}" 
                                        hx-target="#chart"
                                        hx-select="#chart"
                                        hx-include="form"
                                        hx-swap="outerHTML"

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
                            Courses Taught
                        </h3>
                        <div class="flex flex-wrap p-2">
                            @foreach ($courses as $course)
                                <span class=" m-1 p-1">
                                    <input 
                                            type="radio" 
                                            id="{{$course->id}}" 
                                            value="{{$course->id}}" 
                                            class="peer sr-only  " 
                                            name='selected_course'
                                            @if ($prev_course==$course->id)
                                                checked
                                            @endif
                                            hx-get="{{route("professors.show",$professor)}}" 
                                            hx-target="#chart"
                                            hx-select="#chart"
                                            hx-include="form"
                                            hx-swap="outerHTML"
                                        >
                                    <label  
                                        for="{{$course->id}}" 
                                        class="   bg-gray-300 rounded p-1">
                                        {{$course->departmentCode . "-" .  $course->courseNumber}}
                                    </label>
                                </span>
                            @endforeach
                            <span class=" m-1 p-1">
                                <input 
                                        type="radio" 
                                        id="allcourses" 
                                        value="" 
                                        class="peer sr-only  " 
                                        name='selected_course'
                                        @if ($prev_course=="")
                                            checked
                                        @endif
                                        hx-get="{{route("professors.show",$professor)}}" 
                                        hx-target="#chart"
                                        hx-select="#chart"
                                        hx-include="form"
                                        hx-swap="outerHTML"
                                    >
                                <label  
                                    for="allcourses" 
                                    class="   bg-gray-300 rounded p-1">
                                    All Courses
                                </label>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
    </div>
   
</x-header>
