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
        <x-professorCard :professor="$professor"></x-professorCard>
    @endforeach
    </div>
@endif

</x-header>