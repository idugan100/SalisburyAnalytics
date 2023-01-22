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
    <label>Course Description</label>

    <div class="m-4">
        <textarea class="border-2 border-black" name="description" cols="30" rows="10" required>{{$course->description}}</textarea>
    </div> 
    <div class="m-4">
        <label class="mr-2">Syllabus Link</label>
        <input class="border-2 border-black" name="syllabusLink" type="text" value="{{$course->syllabusLink}}" >
    </div>
    <div class="m-4">
        <label class="mr-2">Lab Hours Per Week</label>
        <input class="border-2 border-black" name="creditsLab" type="number" value="{{$course->creditsLab}}" >
    </div>
    <div class="m-4">
        <label class="mr-2">Lecture Hours Per Week</label>
        <input class="border-2 border-black" name="creditsLecture" type="number" value="{{$course->creditsLecture}}" >
    </div>
    <div class="m-4">
        <label class="mr-2">Credit Hours</label>
        <input class="border-2 border-black" name="creditsTotal" type="number" value="{{$course->creditsTotal}}" required>
    </div>
    <button class="bg-gray-200 hover:bg-blue-900 hover:text-white rounded p-1" type="submit">Update</button>
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