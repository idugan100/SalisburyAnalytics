
<form class=" m-3 flex justify-center" action="{{route('professors.index')}}">
    @method('get')
    <select class="border-2 p-2 border-black " name="department" wire:model="selected_department">
        <option  value="{{null}}" >select department</option>
       @foreach ($departments as $department)
           <option value="{{$department["departmentCode"]}}" >{{$department["departmentCode"]}}</option>
       @endforeach
    </select>
    <select class="border-2 p-2 border-black w-1/3" name="professor_id" wire:model="selected_professor">
        <option value="" >select professor</option>
       @foreach ($professors as $professor)
           <option value="{{$professor->id}}" >{{$professor->lastName . ", " . $professor->firstName}}</option>
       @endforeach
    </select>
    <button class="p-2 border-2 border-black hover:bg-black hover:text-white" type="submit">Search</button>
</form>



