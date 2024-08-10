<x-header>

<x-subHeader title="search professors"/>

<form class=" m-3 flex justify-center" action="{{route('professors.index')}}">
    @method('get')
    <select class="border-2 p-2 border-black " name="department" hx-get="/professor_options_by_department" hx-target="#professorSelect" required>
        <option  value="{{null}}" >select department</option>
       @foreach ($departments as $department)
           <option value="{{$department["departmentCode"]}}" >{{$department["departmentCode"]}}</option>
       @endforeach
    </select>
    <select class="border-2 p-2 border-black w-1/3" name="professor_id" id="professorSelect" required>
        <option value="" >select professor</option>
    </select>
    <button class="p-2 border-2 border-black hover:bg-black hover:text-white" type="submit">Search</button>
</form>

@error('search')
    <div class="flex justify-center  text-lg">Please enter the professors first and last name</div>
@enderror

@isset($message)
    <div class="flex justify-center">
        <div class="font-bold m-2">
            {{$message}}
        </div>
    </div>
@endisset

@if(count($professors)==0)
  <p class="flex justify-center flex-wrap text-lg" >We couldn't find that professor. Please double check your spelling.</p>
  
@elseif (!empty($professors))
<div class="flex justify-center" >
    <div class="max-w-3xl p-6">
            @foreach ($professors as $professor)
                <x-professorCard :professor="$professor"></x-professorCard>
            @endforeach
        </div>
        
    </div>
@endif
<div class="mt-4 flex p-4 justify-end">
    @if (!$professors->onFirstPage())
        <a href="{{$professors->previousPageUrl()}}" class="m-2">Previous</a>
    @endif
    @if($professors->hasMorePages())
        <a href="{{$professors->nextPageUrl()}}" class="m-2">Next </a>
    @endif
</div>

</x-header>