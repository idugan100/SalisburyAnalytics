
 <div class="bg-white rounded-lg m-2 p-3 shadow-md">
    <h3 class="text-lg font-bold underline">{{$review->question}}</h3>
    <p>{{$review->response}}</p>
    <div class="bg-gray-200 rounded p-1 my-2">{{$review->course->departmentCode . "-" . $review->course->courseNumber . " | " . $review->professor->firstName . " ". $review->professor->lastName}}</div>
    @auth
    <form  class="m-2" method="POST" action="{{ route('reviews.destroy', $review->id) }}">
        @csrf
        @method('DELETE')
        <button class="hover:underline rounded p-1">Delete</button>
    </form>
    @endauth
</div>   