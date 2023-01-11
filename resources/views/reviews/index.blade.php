<x-header>
    <h2 class="bg-yellow-500 text-center font-bold text-white text-xl">All Reviews</h2>
    <div class="grid grid-cols-3">
        @foreach ($reviews as $review)
        <div class="col-start-2 m-3 border-2 p-2 shadow-md">
            <h3 class="text-lg font-bold underline ">{{$review->question}}</h3>
            <p>{{$review->response}}</p>
            <p class="bg-black text-white">{{$review->course->departmentCode . "-" . $review->course->courseNumber}}</p>
            <p class="bg-black text-white">{{$review->professor->firstName . " " . $review->professor->lastName}}</p>
            <hr>
        </div> 
        @endforeach

    </div>

</x-header>