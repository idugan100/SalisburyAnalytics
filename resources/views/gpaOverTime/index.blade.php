<x-header>
    <x-subHeader title="gpa tracker"/>
    <h3 class="text-center mt-3 text-lg font-bold ">Select Department</h3>
    <form class=" mt-3 flex justify-center" action="{{route('gpa')}}">
        @method('get')
        <select 
            name="Department"
             class="p-2" 
            hx-get="{{route("gpa")}}" 
            hx-target="#GPAchart" 
            hx-select="#GPAchart"  
            hx-swap="outerHTML"
        >
            
            <option @if(old("Department")=="")selected @endif value="">All</option>
            @foreach ($departments as $department)
                <option  @if(old("Department")==$department->departmentCode)selected @endif value="{{$department->departmentCode}}">{{$department->departmentCode}}</option>
            @endforeach
        
        </select>
    </form>
    <div class="m-5 border-solid border-black p-4 border-4 rounded shadow bg-white" style="height: 380px;" >
        <div id="GPAchart">
            {{$gpa_chart->container()}}
            <script src="{{$gpa_chart->cdn()}}"></script>
            {{$gpa_chart->script()}}
        </div>
    </div>
</x-header>
