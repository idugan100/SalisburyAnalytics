<x-header>

<h2 class="bg-black text-center font-bold text-white text-2xl">all professors</h2>

<form class="mt-3 flex justify-center" action="{{route('professors.index')}}">
    @method('get')
    <input placeholder ="John Smith" class="border-3 p-2  " name ="search" type="text">
    <button class="p-2 hover:underline rounded-md  font-bold" type="submit">Search</button>
</form>

    @error('search')
        <div class="flex justify-center  text-lg">Please enter the professors first and last name</div>
    @enderror
@if(count($professors)==0)
  <p class="flex justify-center text-lg" >We couldn't find that professor. Please double check your spelling.</p>
@elseif (!empty($professors))
    <div class="grid lg:grid-cols-6 grid-cols-3">

    @foreach ($professors as $professor)
        <div class=" contrast-125 p-3 shadow-md shadow-sky-500 bg-white rounded-lg m-2 p-2 ">
            <h3 class=" text-2xl p-1 bg-zinc-300 px-2 font-bold underline ">{{$professor->firstName . " " . $professor->lastName . " - " . $professor->department}}</h3>
            <div class="flex rounded-md">
                @auth
                    <form  class="" method="POST" action="{{ route('professors.destroy', $professor->id) }}">
                        @csrf
                        @method('delete')
                        <button class="m-1  border-2 border-sky-500 hover:text-white hover:bg-sky-500 rounded px-1 ">delete</button>
                    </form>     
                    <a class="m-1  border-2 border-sky-500 hover:text-white hover:bg-sky-500 rounded px-1 " href="{{route('professors.edit',$professor->id)}}">edit</a>
                @endauth
                <a class="m-1  border-2 border-sky-500 hover:text-white hover:bg-sky-500 rounded px-1 " href="{{route('professors.show',$professor->id)}}">reviews</a>
            </div>
        </div>   
     
    @endforeach

    </div>
@endif

</x-header>