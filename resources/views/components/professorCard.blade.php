<div class=" w-64 contrast-125 group p-3 shadow-lg  shadow-black  bg-white hover:bg-sky-500 rounded-lg m-2 p-5 ">
    <h3 class=" text-2xl py-1 px-2 font-bold ">{{$professor->firstName . " " . $professor->lastName }}</h3>
    <hr class="border-1 border-sky-500 ">

    <h4 class="text-md   py-1 px-2  m-2 group-hover:text-gray-300 font-bold">{{$professor->department}}</h4>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> Avergage GPA: 3.94</div>
    <div class="px-2 py-1 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Number of Reviews: " . count($professor->reviews)}}</div>

    <div class="flex rounded-md">
        @auth
            <form  class="" method="POST" action="{{ route('professors.destroy', $professor->id) }}">
                @csrf
                @method('delete')
                <button class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1">delete</button>
            </form>     
            <a class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1" href="{{route('professors.edit',$professor->id)}}">edit</a>
        @endauth
        <a class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1" href="{{route('professors.show',$professor->id)}}">reviews</a>
    </div>
</div>   