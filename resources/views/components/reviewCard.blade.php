<div class="  border-4 border-black  contrast-125 group p-3 shadow-lg  shadow-black  bg-white hover:bg-red-800 rounded-lg m-2 p-5 ">
    <h3 class=" text-2xl py-1 px-2 font-bold ">{{$review->course->departmentCode . "-" . $review->course->courseNumber}}</h3>
    <hr class="border-1 border-yellow-400 ">

    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{$review->professor->firstName . " ". $review->professor->lastName}}</div>
    <div class="px-2 py-1 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{$review->response}}</div>

    <div class="flex rounded-md">
        @auth
            @if (auth()->user()->email == env("ADMIN_EMAIL"))
            <form  class="" method="POST" action="{{ route('reviews.destroy', $review->id) }}">
                @csrf
                @method('delete')
                <button class="m-2  border-4 border-yellow-400 hover:text-gray-300 bg-yellow-400 rounded font-bold px-1">delete</button>
            </form>     
            <a class="m-2  border-4 border-yellow-400 hover:text-gray-300 bg-yellow-400 rounded font-bold px-1" href="{{route('reviews.edit',$review->id)}}">edit</a>
            @endif
        @endauth
    </div>
</div> 