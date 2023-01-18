
 <div class="bg-white m-2 p-3 shadow-md">
    <h3 class="text-lg font-bold underline">{{$review->question}}</h3>
    <p>{{$review->response}}</p>
    <p class="bg-black text-white">{{$review->course->departmentCode . "-" . $review->course->courseNumber . " | " . $review->professor->firstName . " ". $review->professor->lastName}}</p>
    @auth
    <form  class="my-2" method="POST" action="{{ route('reviews.destroy', $review->id) }}">
        @csrf
        @method('DELETE')
        <button class="hover:underline rounded p-1">Delete</button>
    </form>
    @endauth
</div>   