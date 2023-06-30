<x-header>

<x-subHeader title="search professors"/>
<form class="my-5 flex justify-center" action="{{route('professors.index')}}">
    @method('get')
    <input placeholder ="John Smith" class="border-3 p-2 " value="{{$search}}" name ="search" type="text">
    <button class="p-2 hover:underline rounded-md  font-bold" type="submit">Search</button>
</form>

@error('search')
    <div class="flex justify-center  text-lg">Please enter the professors first and last name</div>
@enderror

@if(count($professors)==0)
  <p class="flex justify-center text-lg" >We couldn't find that professor. Please double check your spelling.</p>
  
@elseif (!empty($professors))
    <div class="flex justify-center">
        <div class=" grid lg:grid-cols-4 gap-4 grid-cols-3">
            @foreach ($professors as $professor)
                <x-professorCard :professor="$professor"></x-professorCard>
            @endforeach
        </div>
        
    </div>
@endif
<div class="border-solid border-2 mt-4 border-black flex flex-col">
    {{$professors->links()}}

</div>

</x-header>