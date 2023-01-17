<x-header>
    <h2 class="bg-black text-center font-bold text-white text-xl">New Professor</h2>
    <div class="flex justify-center ">
        <form method="POST" action="{{route('professors.store')}}" >
            @csrf
           
            <div class="m-4">
                <label class="mr-2">First Name</label>
                <input class="border-2 border-black" name="firstName" type="text" required>
            </div>
            <div class="m-4">
                <label class="mr-2">Last Name</label>
                <input class="border-2 border-black" name="lastName" type="text" required>
            </div>
            
            <div class="m-4">
                <label class="mr-2">Department Code</label>
                <input class="border-2 border-black" name="department" type="text" required>
            </div>
            <button class="bg-gray-200 hover:bg-blue-900 hover:text-white rounded p-1" type="submit">Submit</button>
        </form>
        </div>
       

</x-header>