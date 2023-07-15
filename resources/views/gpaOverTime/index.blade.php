<x-header>
    <x-subHeader title="gpa tracker"/>
    <h3 class="text-center mt-3 text-lg font-bold ">Select Department</h3>
    <form class=" mt-3 flex justify-center" action="{{route('gpa')}}">
        @method('get')
        <select name="Department" class="p-2">
            <option @if($selected_department=="")selected @endif value="">All</option>
            @foreach ($departments as $department)
                <option  @if($selected_department==$department->departmentCode)selected @endif value="{{$department->departmentCode}}">{{$department->departmentCode}}</option>
            @endforeach
        </select>
        <button class="p-2 border-2 border-black hover:bg-black hover:text-white" type="submit">Filter</button>
    </form>
        <div class="m-5 border-solid border-yellow-500 p-4 border-4 rounded shadow">
            {{$gpa_chart->container()}}
        </div>
    </div>
</x-header>
<script src="{{$gpa_chart->cdn()}}"></script>
{{$gpa_chart->script()}}