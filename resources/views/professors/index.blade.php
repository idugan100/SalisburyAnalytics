<x-header>
    <h2 class="bg-yellow-500 text-center font-bold text-white font-xl">All Professors</h2>
    @if (!empty($professors))
        @foreach ($professors as $professor)
            <h3>{{$professor->firstName . " " . $professor->lastName}}</h3>
            
        @endforeach
        
    @endif

</x-header>