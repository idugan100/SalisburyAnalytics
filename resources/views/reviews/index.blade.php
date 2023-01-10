<x-header>
    <h2 class="bg-yellow-500 text-center font-bold text-white text-xl">All Reviews</h2>
    <div class="grid grid-cols-3">
        @foreach ($reviews as $review)
        <div class="col-start-2">
            <p>{{$review->response}}</p>
            <hr>
        </div> 
        @endforeach

    </div>

</x-header>