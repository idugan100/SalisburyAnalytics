<x-header>
    <h2 class="bg-yellow-500 text-center font-bold text-white text-xl">New Review</h2>
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
                <input class="border-2 border-black" name="departmentCode" type="text">
            </div>
            <div class="m-4">
                <label class="mr-2">Professor Name</label>
                <input class="border-2 border-black" name="professorName" type="text">
            </div>
            <button class="bg-gray-200 hover:bg-blue-900 hover:text-white rounded p-1" type="submit">Submit</button>

        </div>
    </form>

</x-header>