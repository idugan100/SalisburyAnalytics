<x-header>
    <h2 class="bg-yellow-500 text-center font-bold text-white font-xl">All Professors</h2>
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
            </div>

            
            
        @endforeach
            </div>
        </div>
    @endif

</x-header>