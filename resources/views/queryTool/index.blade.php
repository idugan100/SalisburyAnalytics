<x-header>

    <x-subHeader title="query tool"/>
    <form action="{{route("qtool")}}">
        @csrf
        <div class="p-2 flex justify-center content-center flex-wrap"  >
            <span class="mt-4 font-bold">find the</span>
            <select class="m-2" name="quantity" id="" required>
                <option value="1" @if (old("quantity")=="1") selected @endif>1</option>
                <option value="5" @if (old("quantity")=="5") selected @endif>5</option>
                <option value="10" @if (old("quantity")=="10" || old("quantity")==null) selected @endif>10</option>
                <option value="25" @if (old("quantity")=="25") selected @endif>25</option>
                <option value="50" @if (old("quantity")=="50") selected @endif>50</option>
            </select>
            <select class="m-2" name="entity" id=""   required>
                <option value="professors" @if (old("entity")=="professors" || old("entity")==null) selected @endif>professors</option>
                <option value="courses" @if (old("entity")=="courses") selected @endif>courses</option>
            </select>
            <span  class="mt-4 font-bold"> from </span>
            <select class="m-2"  name="department_filter">
                <option value="">any</option>
                @foreach ($departments as $department)
                    <option value="{{$department->departmentCode}}" @if (old("department_filter")==$department->departmentCode) selected @endif>
                        {{$department->departmentCode}}
                    </option>
                @endforeach
                
            </select>
            <span class="mt-4 font-bold"> department with the </span>
            <select  class="m-2" name="ordering" required>
                <option value="desc" @if (old("ordering")=="desc") selected @endif >highest </option>
                <option value="asc" @if (old("ordering")=="asc") selected @endif>lowest</option>
            </select>
            <select class="m-2" name="statistic" required>
                <option value="avg_gpa" @if (old("statistic")=="avg_gpa") selected @endif>average gpa</option>
                <option value="total_enrollment" @if (old("statistic")=="total_enrollment") selected @endif>total students</option>
                <option value="W_rate" @if (old("statistic")=="W_rate") selected @endif> withdraw percentage</option>
                <option value="A_rate" @if (old("statistic")=="A_rate") selected @endif> A percentage</option>
                <option value="B_rate" @if (old("statistic")=="B_rate") selected @endif> B percentage</option>
                <option value="C_rate" @if (old("statistic")=="C_rate") selected @endif> C percentage</option>
                <option value="D_rate" @if (old("statistic")=="D_rate") selected @endif> D percentage</option>
                <option value="F_rate" @if (old("statistic")=="F_rate") selected @endif> F percentage</option>
            </select>
            <button type="submit" class="p-2 bg-yellow-400 text-red-800 font-bold rounded m-2">calculate</button>
        </div>
</form>


<div class="flex justify-center" >
    <div class="max-w-3xl p-6">
        @if (old("entity")=="courses")
            @foreach($results as $result)
                <div class="border p-2 rounded border-4  bg-white border-black m-1">
                    <span class="font-bold">{{$result->{old("statistic")} }}</span>
                    {{  ", " . $result->departmentCode . "-" . $result->courseNumber . " (" .$result->courseTitle .")"}} 
                    <a class="text-red-800 font-bold mx-2" href="{{route("courses.index",['department' => $result->departmentCode, 'courseNumber' => $result->courseNumber])}}">&#8594</a>
                </div>
            @endforeach
        @elseif(old("entity")=="professors")
            @foreach($results as $result)
                <div class="border bg-white p-2 rounded border-4 border-black m-1">
                    <span class="font-bold">{{$result->{old("statistic")} }}</span>
                    {{ ", " . $result->firstName . " " . $result->lastName}} 
                    <a class="text-red-800 font-bold mx-2" href="{{route("professors.index",['professor_id' => $result->id])}}">&#8594</a>
                </div>
            @endforeach
        @endif
        
    </div>
   
</div>


</x-header>