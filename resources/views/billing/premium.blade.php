<x-header>
    <x-subHeader title="features"/>
<div class="m-4">
    <div class="flex justify-center">
        <h3 class="font-bold m-2">for $4 a month you can access:</h3>
    </div>
    <ul class="flex justify-center flex-wrap">
        <div class="grid grid-cols-2">
            <li class="m-2 border-black border-2 p-2  flex flex-col bg-white rounded">
                grade distributions
            </li>
            <li class="m-2 border-black border-2 p-2  flex flex-col bg-white rounded">
                professor reviews
            </li>
            <li class="m-2 border-black border-2 p-2  flex flex-col bg-white rounded">
                average salaries
            </li>
            <li class="m-2 border-black border-2 p-2  flex flex-col bg-white rounded">
                student demographics
            </li>
            <li class="m-2 border-black border-2 p-2  flex flex-col bg-white rounded">
                average gpa
            </li>
            <li class="m-2 border-black border-2 p-2  flex flex-col bg-white rounded">
                course times
            </li>
        </div>
        
    </ul>
    
    <x-carosel/>

    <div class="flex justify-center ">
        <blockquote class="mb-2 bg-white border-black border-2 p-2 rounded w-96">
            <em>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat excepturi beatae sit sint! Neque deleniti labore nobis nemo cum ipsam expedita eveniet iure! Possimus laborum minima beatae non corporis nam." - John Doe</em>
        </blockquote>
    </div>
    <div class="flex justify-center">
        <a href="{{route("register")}}" class="{{env("ACCENT_BG")}} w-96 p-3 rounded text-white font-bold flex justify-center">sign up for 1 week free trial :)</a>
    </div>
</div>
</x-header>