<x-header>
    <x-subHeader title="new review"/>

<div id="defaultModal" tabindex="-1" aria-hidden="true" class="  flex overflow-y-auto overflow-x-hidden  top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <div class="relative p-4 shadow-lg shadow-black bg-white hover:bg-sky-500 group rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 group-hover:border-gray-300 border-sky-500">
                <h3 class="text-lg font-bold text-black dark:text-white">
                    Add Review
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{route("reviews.store")}}" method="post">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                      <div>
                        <label for="category2" class="block mb-2 font-bold text-sm  text-black dark:text-white">Course</label>
                        <select id="category2" name="courseID" class="bg-gray-200 border border-gray-200 text-black text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select course</option>
                            @foreach ($courseList as $course)
                                <option value="{{$course->id}}">{{$course->departmentCode . "-" . $course->courseNumber}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="category" class="block mb-2 text-sm font-bold text-black dark:text-white">Professor</label>
                        <select id="category" name="professorID" class="bg-gray-200 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" selected>Select professor</option>
                            @foreach ($professorList as $professor)
                                <option value="{{$professor->id}}">{{$professor->firstName . " " . $professor->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Review</label>
                        <textarea id="description" name="response" rows="4" class="block p-2.5 w-full text-sm text-black bg-gray-200 rounded-lg border border-gray-300 focus:ring-sky-500 focus:border-sky-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write your review here"></textarea>                    
                    </div>
                </div>
                <button type="submit" class="m-2  border-4 border-sky-500 hover:text-gray-300 bg-sky-500 rounded font-bold px-1 flex">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    add review
                </button>
            </form>
        </div>
    </div>
</div>


</x-header>