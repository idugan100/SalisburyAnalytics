<x-header>
    <h1 class="text-xl font-bold underline">{{$professor->firstName . " " . $professor->lastName}}</h1>
    @foreach ($professor->reviews as $item)
    <p>{{$item->response}}</p>
    <hr>
        
    @endforeach
</x-header>