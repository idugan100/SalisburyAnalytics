<div class=" w-64 contrast-125 p-3 shadow-lg shadow-sky-600 bg-white hover:bg-sky-500 rounded-lg m-2 p-5 ">
    <h3 class=" text-2xl p-1  px-2 font-bold  ">{{$professor->firstName . " " . $professor->lastName }}</h3>
    <h4 class="text-lg  p-1  px-2  text-gray-500 font-bold">{{$professor->department}}</h4>
    <div class="flex rounded-md">
        @auth
            <form  class="" method="POST" action="{{ route('professors.destroy', $professor->id) }}">
                @csrf
                @method('delete')
                <button class="m-1  border-2 border-sky-500 hover:text-white hover:bg-sky-500 rounded px-1 ">delete</button>
            </form>     
            <a class="m-1  border-2 border-sky-500 hover:text-white hover:bg-sky-500 rounded px-1 " href="{{route('professors.edit',$professor->id)}}">edit</a>
        @endauth
        <a class="m-1  border-4 border-sky-500 hover:text-white bg-sky-500 rounded font-bold px-1" href="{{route('professors.show',$professor->id)}}">reviews</a>
    </div>
</div>   