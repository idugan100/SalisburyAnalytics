<x-header>
    <x-subHeader title="enrollment tracker"/>
    <h3 class="text-center mt-3 text-lg font-bold ">Select Department</h3>
    <form class=" mt-3 flex justify-center" action="{{route('enrollment')}}">
        @method('get')
        <select 
            name="Department"
            class="p-2"
            hx-get="{{route("enrollment")}}" 
            hx-target="#EnrollmentChart" 
            hx-select="#EnrollmentChart"  
            hx-swap="outerHTML"
        >
            <option @if(old("Department")=="")selected @endif value="">All</option>
            @foreach ($departments as $department)
                <option  @if(old("Department")==$department->departmentCode)selected @endif value="{{$department->departmentCode}}">{{$department->departmentCode}}</option>
            @endforeach
        </select>
    </form>
        <div class="m-5 border-solid border-yellow-500 p-4 border-4 rounded shadow" style="height: 380px;">
            <div id="EnrollmentChart">
                {{$enrollment_chart->container()}}
                <script src="{{$enrollment_chart->cdn()}}"></script>
                {{$enrollment_chart->script()}}
            </div>
        </div>
</x-header>
