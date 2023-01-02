<x-header>
    <h2 class="bg-yellow-500 text-center font-bold text-white font-xl">New Professor</h2>
    <div class="flex justify-center ">
        <form method="POST" action="{{route('professors.store')}}" >
            @csrf
           
            <div class="m-4">
                <label class="mr-2">First Name</label>
                <input class="border-2 border-black" name="departmentCode" type="text">
            </div>
            <div class="m-4">
                <label class="mr-2">Last Name</label>
                <input class="border-2 border-black" name="courseNumber" type="text">
            </div>
            
            <div class="m-4">
                <label class="mr-2">Department Code</label>
                <input class="border-2 border-black" name="creditsTotal" type="number">
            </div>
            <button class="bg-gray-200 hover:bg-blue-900 hover:text-white rounded p-1" type="submit">Submit</button>
        </form>
        </div>

</x-header>