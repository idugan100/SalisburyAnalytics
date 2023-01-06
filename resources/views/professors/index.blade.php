<x-header>
    <h2 class="bg-yellow-500 text-center font-bold text-white text-xl">All Professors</h2>
  <form class="flex justify-center" action="">
    <input class="border-2 p-2 border-black"type="text">
    <button class="p-2 border-2 border-black hover:bg-black hover:text-white" type="submit">Search</button>
  </form>
    @if (!empty($professors))
        <div class="flex justify-center border-2">
            <div >
        @foreach ($professors as $professor)
                <div class="m-3 border-2">
                <h3 class=" text-2xl p-2 max-w-sm">{{$professor->firstName . " " . $professor->lastName . " - " . $professor->department}}</h3>
                <form  class="m-2" method="POST" action="{{ route('professors.destroy', $professor->id) }}">
                    @csrf
                    @method('delete')
                    <button class="bg-gray-200 hover:bg-red-900 hover:text-white rounded p-1">Delete</button>
        
                </form>
             
                <a class="m-2 bg-gray-200 hover:bg-blue-900 hover:text-white rounded p-1" href="{{route('professors.edit',$professor->id)}}">edit</a>
            </div>

            
            
        @endforeach
            </div>
        </div>
    @endif

</x-header>