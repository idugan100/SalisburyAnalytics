<x-header>

<x-subHeader title="search professors"/>
<livewire:search-professors :selected_department="$result_department" :selected_professor='$result_professor'/>

@error('search')
    <div class="flex justify-center  text-lg">Please enter the professors first and last name</div>
@enderror

@if(count($professors)==0)
  <p class="flex justify-center flex-wrap text-lg" >We couldn't find that professor. Please double check your spelling.</p>
  
@elseif (!empty($professors))
    <div class="flex justify-center">
        <div class=" grid lg:grid-cols-4 md:grid-cols-3 gap-4 grid-cols-1">
            @foreach ($professors as $professor)
                <x-professorCard :professor="$professor"></x-professorCard>
            @endforeach
        </div>
        
    </div>
@endif
<div class="m-4  flex flex-col ">
    {{$professors->links()}}

</div>

</x-header>