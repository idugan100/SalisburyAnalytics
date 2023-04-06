{{-- 
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
</div>    --}}


<div class="  contrast-125 group p-3 shadow-lg  shadow-black  bg-white hover:bg-sky-500 rounded-lg m-2 p-5 ">
    <h3 class=" text-2xl py-1 px-2 font-bold ">{{$review->course->departmentCode . "-" . $review->course->courseNumber}}</h3>
    <hr class="border-1 border-sky-500 ">

    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{$review->professor->firstName . " ". $review->professor->lastName}}</div>
    <div class="px-2 py-1 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{$review->response}}</div>

    <div class="flex rounded-md">
        @auth
            <form  class="" method="POST" action="{{ route('reviews.destroy', $review->id) }}">
                @csrf
                @method('delete')
                <button class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1">delete</button>
            </form>     
            <a class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1" href="{{route('reviews.edit',$review->id)}}">edit</a>
        @endauth
    </div>
    <a class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1" href="{{route('courses.show',$review->course->id)}}">reviews</a>
    <a class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1" href="">charts</a>

</div> 