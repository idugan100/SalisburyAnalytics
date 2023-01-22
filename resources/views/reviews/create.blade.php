<x-header>
    <x-subHeader title="new review"/>

    <form  class= "grid grid-cols-3"action="{{route("reviews.store")}}" method="post">
        @csrf
        <div class="col-start-2">
            <div class="m-4">
                <label class="mr-2" >Question</label>
                <input class="border-2 border-black"  name="question" type="text">
            </div>
            <div class="m-4">
                <label class="mr-2">Response</label>
                <textarea class="border-2 border-black" name="response" ></textarea>
            </div>
            <div class="m-4">
                <label class="mr-2">Deparment Code</label>
                <select name="courseID" class="bg-white p-1 border-2 border-black" >
                    @foreach ($courseList as $course)
                        <option value="{{$course->id}}">{{$course->departmentCode . "-" . $course->courseNumber}}</option>
                    @endforeach
                </select>
            </div>
            <div class="m-4">
                <label class="mr-2">Professor Name</label>
                <select name="professorID" class="bg-white p-1 border-2 border-black" >
                    @foreach ($professorList as $professor)
                        <option value="{{$professor->id}}">{{$professor->firstName . " " . $professor->lastName}}</option>
                    @endforeach
                </select>
            </div>
            <button class="bg-gray-200 hover:bg-blue-900 hover:text-white rounded p-1" type="submit">Submit</button>

        </div>
    </form>

</x-header>