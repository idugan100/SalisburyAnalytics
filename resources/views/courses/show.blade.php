<x-header>
    <x-subHeader :title="'grade distribution '.$course->departmentCode . '-' . $course->courseNumber"/>
        <div class="flex justify-center">
     
                
                <div class="relative max-w-5xl	 bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            {{"Grade Distribution for " . $course->departmentCode ."-" . $course->courseNumber }} 
                        </h3>
                        
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        {{$chart->container()}}
                        <h3 class="text-lg font-semibold text-gray-900 ">
                            Semesters Taught 
                        </h3>
                        <div class="flex flex-wrap p-2">
                            @foreach ($semesters as $semester_object)
                                <span class="py-1 px-2 m-1 rounded-full text-sm bg-gray-200 hover:bg-gray-300 hover:drop-shadow-md duration-300">
                                    {{$semester_object->semester . " " . $semester_object->year}}
                                </span>
                            @endforeach
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 ">
                            Frequently Taught By
                        </h3>
                        <div class="flex flex-wrap p-2">
                            @foreach ($topProfessors as $top_professor)
                                <a href="{{route("professors.index",[ 'department' => $course->departmentCode,"professor_id"=>$top_professor->id])}}" class="py-1 px-2 m-1 rounded-full text-sm bg-gray-200 hover:bg-gray-300 hover:drop-shadow-md duration-300">
                                    {{$top_professor->firstName . " " . $top_professor->lastName}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
        <script src="{{$chart->cdn()}}"></script>
        {{$chart->script()}}
        
    </div>
</x-header>