
<x-header>

<x-subHeader title="search courses"/>

<livewire:search-courses :selected_department="$result_department" :selected_course='$result_courseNumber'/>

@error('search')
    <div class="flex justify-center  text-lg">Please enter your search in the following format: DEPT-123</div>
@enderror

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