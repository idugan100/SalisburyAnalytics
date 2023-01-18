<x-header>
    <h2 class="bg-black text-center font-bold text-white text-2xl">all reviews</h2>
    <div class="grid grid-cols-3">
        <div class="col-start-2">
        @foreach ($reviews as $review)
        <x-reviewCard :review="$review"></x-reviewCard>   
        @endforeach
        </div>
    </div>

</x-header>