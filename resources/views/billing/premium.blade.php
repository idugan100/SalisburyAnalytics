<x-header>
    <x-subHeader title="premium features"/>
<div class="m-4">
           <div class="flex justify-center">
            <h3 class="font-bold m-2">you clicked on a premium feature! for three dollars each month you can have access to the below functionality:</h3>
           </div>
    <ul class="md:flex justify-center flex-wrap">
        <li class="m-2 border-black border-2 h-120 w-100 p-2  flex flex-col bg-white rounded">
            <img src="{{ URL::asset('query_tool_image.png') }}" alt="" class="h-80  w-120">
            <div>query tool that allows you to create custom reports about professors, courses, departments, enrollment, gpa, withdraw rates and more</div>
        </li>
    </ul>
    <div class="flex justify-center">
        <a href="{{route("register")}}" class="{{env("ACCENT_BG")}} w-1/3 p-3 rounded font-bold flex justify-center">sign up now :)</a>
    </div>
    <div class="flex justify-center">
        <span class="mx-1">already a user?</span>
        <a href="{{route("login")}}" class="underline {{env("ACCENT_TEXT_COLOR")}}"> sign in</a>
    </div>

</div>
</x-header>