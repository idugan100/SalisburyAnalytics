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
        <div class="  bg-white rounded-lg m-2 p-2 shadow-md">
            <h3 class=" text-xl p-2  font-bold max-w-sm">{{$professor->firstName . " " . $professor->lastName . " - " . $professor->department}}</h3>
            <div class="flex bg-gray-200 rounded-md">
                @auth
                    <form  class="m-1" method="POST" action="{{ route('professors.destroy', $professor->id) }}">
                        @csrf
                        @method('delete')
                        <button class="hover:underline rounded ">delete</button>
                    </form>     
                    <a class="m-1  hover:underline  rounded " href="{{route('professors.edit',$professor->id)}}">edit</a>
                @endauth
                <a class="m-1 hover:underline rounded " href="{{route('professors.show',$professor->id)}}">reviews</a>
            </div>
        </div>   
     
    @endforeach

    </div>
@endif

</x-header>