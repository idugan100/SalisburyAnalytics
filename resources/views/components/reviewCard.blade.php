<div class=" contrast-125 group p-5 shadow-lg  shadow-black  bg-white hover:{{env("ACCENT_BG")}} rounded-lg m-2  ">
    <h3 class=" text-2xl py-1 px-2 font-bold ">{{$review->course->departmentCode . "-" . $review->course->courseNumber}}</h3>
    <hr class="border-1 {{env("MAIN_BORDER")}} ">

    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{$review->professor->firstName . " ". $review->professor->lastName}}</div>
    <div class="px-2 py-1 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{$review->response}}</div>

    <div class="flex rounded-md">
        @auth
            @if (auth()->user()->email == env("ADMIN_EMAIL"))
                <form method="GET" action="{{ route('review.reject', $review->id) }}" onsubmit="return confirm('Do you really want to reject this review?');">
                    @csrf
                    <button class="m-2  border-4 {{env("MAIN_BORDER")}} hover:text-gray-300 {{env("MAIN_BG")}} rounded font-bold px-1">reject</button>
                </form>     
            @endif
        @endauth
    </div>
</div> 