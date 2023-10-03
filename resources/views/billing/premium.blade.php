<x-header>
    <x-subHeader title="premium features"/>
<div class="m-4">
           <div class="flex justify-center">
            <h3 class="font-bold m-2">you clicked on a premium feature! for three dollars each month you can have access to the below functionality:</h3>
           </div>
    <ul class="md:flex justify-center flex-wrap">
        <li class="m-2 border-black h-72 border-2 w-80 p-2 flex flex-col bg-white rounded ">
            <img src="{{ URL::asset('gpa_chart_image.png') }}" class="h-44 w-96" alt="">
            <div>
                grade point average and enrollment tracking charts that can be filtered by department to show trends over time
            </div>
        </li>
        <li class="m-2 border-black border-2 h-72 w-80 p-2  flex flex-col bg-white rounded"> 
            <img src="{{ URL::asset('grade_distribution_image.png') }}" alt="" class="h-44 border-2 border-gray-300 w-96">
            <div>grade distributions by course, semester, and professor that gives detailed insight about future classes and lets you see how you stacked up in previous classes</div>
        </li>
        <li class="m-2 border-black border-2 h-72 w-80 p-2  flex flex-col bg-white rounded">
            <img src="{{ URL::asset('query_tool_image.png') }}" alt="" class="h-44  w-80">
            <div>query tool that allows you to create custom reports about professors, courses, departments, enrollment, gpa, withdraw rates and more</div>
        </li>
    </ul>
    <div class="flex justify-center">
        <a href="{{route("register")}}" class="bg-red-800 w-1/3 p-3 rounded text-yellow-400 font-bold flex justify-center">sign up now :)</a>
    </div>
    <div class="flex justify-center">
        <span class="mx-1">already a user?</span>
        <a href="{{route("login")}}" class="underline text-red-800"> sign in</a>
    </div>

</div>
</x-header>