<x-header>
    <x-subHeader title="edit course"/>
<div class="flex justify-center ">
<form method="POST" action="{{route('courses.update',$course->id)}}" >
    @csrf
    @method('put')

    <div class="m-4">
        <label class="mr-2">Course Title</label>
        <input class="border-2 border-black" name="courseTitle" type="text"  value="{{$course->courseTitle}}" required>
    </div>
   
    <div class="m-4">
        <label class="mr-2">Department Code</label>
        <input class="border-2 border-black" name="departmentCode" type="text" value="{{$course->departmentCode}}" required>
    </div>
    <div class="m-4">
        <label class="mr-2">Course Number</label>
        <input class="border-2 border-black" name="courseNumber" type="text" value="{{$course->courseNumber}}" required>
    </div>
    <div class="m-4">
        <label>Course Description</label>
    </div> 
    <div class="m-4">
        <textarea class="border-2 border-black" name="description" cols="30" rows="10" required>{{$course->description}}</textarea>
    </div>
    <button class="m-2  border-4 border-yellow-400 hover:text-gray-300 bg-yellow-400 rounded font-bold px-1" type="submit">Update</button>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</form>
</div>
</x-header>