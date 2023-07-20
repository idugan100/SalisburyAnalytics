
    <form class=" mt-3 flex justify-center" action="{{route('courses.index')}}">
        @method('get')
        <select class="border-2 p-2 border-black " name="department" wire:model="selected_department">
            <option  value="{{null}}" >select department</option>
           @foreach ($departments as $department)
               <option value="{{$department->departmentCode}}" >{{$department->departmentCode}}</option>
           @endforeach
        </select>
        <select class="border-2 p-2 border-black w-1/3" name="courseNumber" wire:model="selected_course">
            <option value="" >select course</option>
           @foreach ($courses as $course)
               <option value="{{$course->courseNumber}}" >{{$course->courseNumber . " - " . $course->courseTitle}}</option>
           @endforeach
        </select>
        <button class="p-2 border-2 border-black hover:bg-black hover:text-white" type="submit">Search</button>
    </form>


