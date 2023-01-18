<x-header>
    <h2 class="bg-black text-center font-bold text-white text-xl">{{"Reviews For " . $professor->firstName . " " . $professor->lastName}}</h2>
    <div class=" grid grid-cols-3 bg-gray-100">
        <div class="col-start-2">
            @foreach ($professor->reviews as $review)
              <x-reviewCard :review="$review"></x-reviewCard>   
            @endforeach
        </div>
        
    </div>
</x-header>
