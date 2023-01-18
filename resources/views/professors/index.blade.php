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
    <div class="flex justify-center ">
    <div >

    @foreach ($professors as $professor)
        <div class="  m-3  flex">
        <h3 class=" text-xl p-2  font-bold max-w-sm">{{$professor->firstName . " " . $professor->lastName . " - " . $professor->department}}</h3>
        @auth
            <form  class="m-2" method="POST" action="{{ route('professors.destroy', $professor->id) }}">
                @csrf
                @method('delete')
                <button class="hover:underline rounded p-1">delete</button>
            </form>     
            <a class="m-2  hover:underline  rounded p-1" href="{{route('professors.edit',$professor->id)}}">edit</a>
        @endauth
        <a class="m-2 hover:underline rounded p-1" href="{{route('professors.show',$professor->id)}}">reviews</a>

        </div>   
        <div class="border-b-2 border-black"></div>
     
    @endforeach

    </div>
    </div>
@endif

</x-header>