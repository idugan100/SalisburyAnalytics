<x-header>
    <h2 class="bg-yellow-500 text-center font-bold text-white font-xl">All Professors</h2>
    @if (!empty($professors))
        <div class="flex justify-center border-2">
            <div>
        @foreach ($professors as $professor)
           
                <h3 class="border-2 m-3 text-2xl p-2 max-w-sm">{{$professor->firstName . " " . $professor->lastName . " - " . $professor->department}}</h3>

            
            
        @endforeach
            </div>
        </div>
    @endif

</x-header>