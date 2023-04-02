
 <div class="bg-white  rounded-lg m-6 contrast-125 p-3 shadow-lg shadow-sky-500">
    @if (isset($review->question))
        <h3 class=" text-lg font-bold bg-zinc-300 p-1 underline">{{$review->question}}</h3>
    @endif
    <p class="m-2">{{$review->response}}</p>
    <hr class=" border-black border">
    <div class="bg-gray-200 rounded p-1 my-2">{{$review->course->departmentCode . "-" . $review->course->courseNumber . " | " . $review->professor->firstName . " ". $review->professor->lastName}}</div>
    @auth
    <form  class="m-2" method="POST" action="{{ route('reviews.destroy', $review->id) }}">
        @csrf
        @method('DELETE')
        <button class="m-1  border-2 border-sky-500 hover:text-white hover:bg-sky-500 rounded px-1">Delete</button>
    </form>
    @endauth
</div>   


