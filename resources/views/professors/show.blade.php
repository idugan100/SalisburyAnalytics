<x-header>
    <h2 class="bg-black text-center font-bold text-white text-xl">{{"Reviews For " . $professor->firstName . " " . $professor->lastName}}</h2>
    <div class=" grid grid-cols-3 bg-gray-100">
        <div class="col-start-2">
            @foreach ($professor->reviews as $item)
                <div class="bg-white m-2 p-3 shadow-md">
                    <h3 class="text-lg font-bold underline">{{$item->question}}</h3>
                    <p>{{$item->response}}</p>
                    <p class="bg-black text-white">{{$item->course->departmentCode . "-" . $item->course->courseNumber}}</p>
                    @auth
                    <form  class="my-2" method="POST" action="{{ route('reviews.destroy', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="hover:underline rounded p-1">Delete</button>
                    </form>
                    @endauth
                </div>   
            @endforeach
        </div>
        
    </div>
</x-header>
