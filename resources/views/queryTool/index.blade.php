<x-header>

    <x-subHeader title="query tool"/>
    <form action="{{route("qtool")}}">
        @csrf
        <div class="p-2" x-data="{ dept_filter: true }" >
            <span>select</span>
            <select name="quantity" id="" required>
                <option value="1">1</option>
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <select name="entity" id=""  x-on:change=" dept_filter=$event.target.value!=='departments' " required>
                <option value="professors">professors</option>
                <option value="courses">courses</option>
                {{-- <option value="departments" selected>departments</option> --}}
            </select>
            <span x-show="dept_filter"> from </span>
            <select x-show="dept_filter" name="department_filter">
                <option value="">any</option>
                @foreach ($departments as $department)
                    <option value="{{$department->departmentCode}}">{{$department->departmentCode}}</option>
                @endforeach
                
            </select>
            <span x-show="dept_filter">department </span>
            <span> with the </span>
            <select name="ordering" required>
                <option value="desc">highest </option>
                <option value="asc">lowest</option>
            </select>
            <select name="statistic" required>
                <option value="avg_gpa">average gpa</option>
                <option value="total_enrollment">total students</option>
                <option value="W_rate"> withdraw percentage</option>
                <option value="A_rate"> A percentage</option>
                <option value="B_rate"> B percentage</option>
                <option value="C_rate"> C percentage</option>
                <option value="D_rate"> D percentage</option>
                <option value="F_rate"> F percentage</option>
            </select>
            <button type="submit" class="p-2 bg-yellow-500 text-red-700 font-bold rounded">submit</button>
        </div>
</form>


</x-header>