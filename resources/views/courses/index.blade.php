
<x-header>

<x-subHeader title="search courses"/>

<form class=" mt-3 flex justify-center" action="{{route('courses.index')}}">
    @method('get')

    <select class="border-2 p-2 border-black " name="department"  hx-get="/course_options_by_department" hx-target="#courseNumberSelect">
        <option  value="{{null}}" >select department</option>
       @foreach ($departments as $department)
           <option value="{{$department["departmentCode"]}}" >{{$department["departmentCode"]}}</option>
       @endforeach
    </select>

    <select class="border-2 p-2 border-black w-1/3" name="courseNumber" wire:model="selected_course" id="courseNumberSelect">
        <option value="" >select course</option>
    </select>
    
    <button class="p-2 border-2 border-black hover:bg-black hover:text-white" type="submit">Search</button>
</form>

@error('search')
    <div class="flex justify-center  text-lg">error occured during search, please refresh page and try again</div>
@enderror

@isset($result_message)
    <div class="flex justify-center">
        <div class="font-bold m-2">
            {{$result_message}}
        </div>
    </div>
@endisset

@if(count($courses)==0)
  <p class="flex justify-center text-lg" >We couldn't find that course. Please double check the department code and course number</p>
@else 
    <div class="flex justify-center" >
    <div class="max-w-3xl p-6">
    @foreach ($courses as $course)
       <x-courseCard :course="$course"></x-courseCard>
    @endforeach
    </div>
    </div>
@endif
<div class="border-solid border-2 mt-4 border-black flex flex-col">
    {{$courses->links()}}

</div>
</x-header>