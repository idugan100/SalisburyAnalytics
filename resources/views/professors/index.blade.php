<x-header>

<h2 class="bg-yellow-500 text-center font-bold text-white text-xl">All Professors</h2>

<form class="flex justify-center" action="{{route('professors.index')}}">
    @method('get')
    <input placeholder ="John Smith" class="border-2 p-2 border-black " name ="search" type="text">
    <button class="p-2 border-2 border-black hover:bg-black hover:text-white" type="submit">Search</button>
</form>

@error('search')
    <div class="flex justify-center text-red-800 text-lg">Please enter the professors first and last name</div>
@enderror

@if (!empty($professors))
    <div class="flex justify-center ">
    <div >

    @foreach ($professors as $professor)
        <div class="m-3 border-2 flex shadow-md">
        <h3 class=" text-2xl p-2 max-w-sm">{{$professor->firstName . " " . $professor->lastName . " - " . $professor->department}}</h3>
        @auth
            <form  class="m-2" method="POST" action="{{ route('professors.destroy', $professor->id) }}">
                @csrf
                @method('delete')
                <button class="bg-gray-200 hover:bg-red-900 hover:text-white rounded p-1">Delete</button>
            </form>     
            <a class="m-2 bg-gray-200 hover:bg-blue-900 hover:text-white rounded p-1" href="{{route('professors.edit',$professor->id)}}">edit</a>
        @endauth
        <a class="m-2 bg-gray-200 hover:bg-blue-900 hover:text-white rounded p-1" href="{{route('professors.show',$professor->id)}}">reviews</a>

        </div>        
    @endforeach

    </div>
    </div>
@endif

</x-header>