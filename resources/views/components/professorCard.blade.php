<div class=" w-64 contrast-125 group p-3 shadow-lg  shadow-black  bg-white hover:bg-sky-500 rounded-lg m-2 p-5 ">
    <h3 class=" text-2xl py-1 px-2 font-bold ">{{$professor->firstName . " " . $professor->lastName }}</h3>
    <hr class="border-1 border-sky-500 ">

    <h4 class="text-md   py-1 px-2  m-2 group-hover:text-gray-300 font-bold">{{$professor->department}}</h4>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Avergage GPA: " . $professor->avg_gpa}}</div>
    <div class=" py-1 px-2 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Students Taught since 2017: " . $professor->qty_A + $professor->qty_B + $professor->qty_C + $professor->qty_D + $professor->qty_F + $professor->qty_W}}</div>
    <div class="px-2 py-1 m-2  text-md font-bold bg-gray-300 rounded border-3 boder-gray-300"> {{"Number of Reviews: " . count($professor->reviews)}}</div>

    <div class="flex rounded-md">
        @auth
            <form  class="" method="POST" action="{{ route('professors.destroy', $professor->id) }}">
                @csrf
                @method('delete')
                <button class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1">delete</button>
            </form>     
            <a class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1" href="{{route('professors.edit',$professor->id)}}">edit</a>
        @endauth
        <a class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1" href="{{route('professors.show',$professor->id)}}">reviews</a>
        <button data-modal-target="{{"Professor-Modal-".$professor->id}}" data-modal-toggle="{{"Professor-Modal-".$professor->id}}" class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1" type="button">Charts</button>
    </div>
</div>   

<!-- Modal content -->
<div id="{{"Professor-Modal-".$professor->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{"Grade Distribution for " . $professor->firstName ." " . $professor->lastName }} 
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide={{"Professor-Modal-".$professor->id}}>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                {{$professor->chart->container()}}
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="{{"Professor-Modal-".$professor->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="{{$professor->chart->cdn()}}"></script>
{{$professor->chart->script()}}