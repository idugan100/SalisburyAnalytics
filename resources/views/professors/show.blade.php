<x-header>
    <h2 class="bg-black text-center font-bold text-white text-xl">{{"Reviews For " . $professor->firstName . " " . $professor->lastName}}</h2>
    <div class=" grid grid-cols-3">
        @if (count($professor->reviews)==0)
            <div class="flex justify-center col-start-2  text-lg">Sorry no reviews found for this professor</div>
        @endif
        <div class="col-start-2">
            @foreach ($professor->reviews as $review)
              <x-reviewCard :review="$review"></x-reviewCard>   
            @endforeach
        </div>
        
    </div>
</x-header>
