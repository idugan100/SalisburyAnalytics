<div class="p-2">
    <label for="courseSelection" class="block mb-2 font-bold text-md text-black">Course</label>
    <select   id="courseSelection" name="courseID" class="bg-gray-200 border border-gray-200 text-black text-sm rounded-lg focus:ring-red-700 focus:border-red-700 block w-full p-2.5" required>
        <option value="">Select course</option>
        @foreach ($courseList as $course)
            <option value="{{$course->id}}">{{$course->courseNumber . " - " . $course->courseTitle}}</option>
        @endforeach
    </select>
</div>
<div class="p-2">
    <label for="professorSelection" class="block mb-2 text-md font-bold text-black ">Professor</label>
    <select required id="professorSelection" name="professorID" class="bg-gray-200 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-red-700 focus:border-red-700 block w-full p-2.5">
        <option value="" selected>Select professor</option>
        @foreach ($professorList as $professor)
            <option value="{{$professor->id}}">{{$professor->lastName . ", " . $professor->firstName}}</option>
        @endforeach
    </select>
</div>