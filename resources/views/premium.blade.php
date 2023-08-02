<x-header>
    <x-subHeader title="premium features"/>
<div class="m-4">
           <div class="flex justify-center">
            <h3>You clicked on a premium feature! For three dollars each month you can have access to the below functionaliy:</h3>
           </div>
    <ul class="md:flex justify-center flex-wrap">
        <li class="m-2 border-black h-1/6 border-2 w-42 p-2 flex flex-col ">
            <img src="{{ URL::asset('gpa_chart_image.png') }}" class="h-32" alt="">
            <div>
                grade point average and enrollment over time charts
            </div>
        </li>
        <li class="m-2 border-black border-2 h-1/6 w-42 p-2  flex flex-col"> 
            <img src="{{ URL::asset('grade_distribution_image.png') }}" alt="" class="h-32">
            <div>grade distributions for individual courses and professors</div>
        </li>
        <li class="m-2 border-black border-2 h-1/6 w-42 p-2  flex flex-col">
            <img src="{{ URL::asset('course_cards_image.png') }}" alt="" class="h-32">
            <div>lists of easiest and hardest courses/professors</div>
        </li>
    </ul>
    <div class="flex justify-center">
        <a href="{{route("register")}}" class="bg-red-700 p-3 rounded text-yellow-500 font-bold">sign up now :)</a>
    </div>
</div>
</x-header>