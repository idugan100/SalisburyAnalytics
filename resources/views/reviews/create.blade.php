<x-header>
    <x-subHeader title="new review"/>

<div id="defaultModal" tabindex="-1" aria-hidden="true" class="  flex overflow-y-auto overflow-x-hidden  top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <div class="relative p-4 shadow-lg shadow-black bg-white hover:bg-yellow-500 group rounded-lg shadow  sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 border-red-700 ">
                <h3 class="text-2xl font-bold text-black">
                    Add Review
                </h3>
            </div>
            <form action="{{route("reviews.store")}}" method="post">
                @csrf
                <div class="  mb-4">
                    <div class="p-2">
                        <label  class="block mb-2 font-bold text-md text-black">Department</label>
                        <select  required name="departmentCode" class="bg-gray-200 border border-gray-200 text-black text-sm rounded-lg focus:ring-red-700 focus:border-red-700 block w-full p-2.5" hx-get="/review_options_by_department" hx-target="#courseProfessorSelection">
                            <option value="">Select department</option>
                            @foreach ($departmentList as $department)
                                <option value="{{$department["departmentCode"]}}">{{$department["departmentCode"]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="col-span-2" id="courseProfessorSelection">
                        <div class="p-2">
                            <label for="courseSelection" class="block mb-2 font-bold text-md text-black">Course</label>
                            <select  id="courseSelection" name="courseID" class="bg-gray-200 border border-gray-200 text-black text-sm rounded-lg focus:ring-red-700 focus:border-red-700 block w-full p-2.5" required>
                                <option value="">Select course</option>
                            </select>
                        </div>
                        <div class="p-2">
                            <label for="professorSelection" class="block mb-2 text-md font-bold text-black">Professor</label>
                            <select  id="professorSelection" name="professorID" class="bg-gray-200 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-red-700 focus:border-red-700 block w-full p-2.5" required>
                                <option value="" selected>Select professor</option>
                            </select>
                        </div>
                    </span>
                    
                    
                    <div class="sm:col-span-3 p-2">
                        <label for="description" class="block mb-2 text-md font-bold text-gray-900">Review</label>
                        <textarea id="description" name="response" rows="4" class="block p-2.5 w-full text-sm text-black bg-gray-200 rounded-lg border border-gray-300 focus:ring-red-700 focus:border-red-700" placeholder="Write your review here" required></textarea>                    
                    </div>
                </div>
                <button type="submit" class="m-2  border-4 border-red-700 hover:text-white bg-red-700 rounded font-bold px-1 flex">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    add review
                </button>
            </form>
        </div>
    </div>
</div>


</x-header>