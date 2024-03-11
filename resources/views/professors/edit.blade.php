<x-header>
    <x-subHeader title="edit professor"/>
    <div class="flex justify-center ">
        <form method="POST" action="{{route("professors.update",$professor->id)}}">
            @csrf
            @method('put')
           
            <div class="m-4">
                <label class="mr-2">First Name</label>
                <input class="border-2 border-black" value='{{$professor->firstName}}'name="firstName" type="text" required>
            </div>
            <div class="m-4">
                <label class="mr-2">Last Name</label>
                <input class="border-2 border-black" value='{{$professor->lastName}}'name="lastName" type="text" required>
            </div>
            <button class="self-end m-2  border-4 border-yellow-400 hover:text-gray-300 bg-yellow-400 rounded font-bold px-1" type="submit">Submit</button>
        </form>
        </div>
</x-header>