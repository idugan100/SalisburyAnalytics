<nav class="p-3   text-xl font-sans font-bold px-5 py-2 rounded-lg">
    @auth
        <a class=" hover:underline px-5 py-2 rounded-lg bold" href="{{route("courses.create")}}">new course</a>
        <a href="{{route("professors.create")}}" class=" hover:underline px-5 py-2 rounded-lg bold ">new professor</a> 
        <a href="{{route("reviews.create")}}" class=" hover:underline px-5 py-2 rounded-lg bold ">new review</a> 
        <a href="/home" class=" hover:underline px-5 py-2 rounded-lg bold ">home</a> 

    @endauth
    <a href="{{route("reviews.index")}}" class=" hover:underline px-5 py-2 rounded-lg bold ">all reviews</a>
    <a href="{{route("professors.index")}}" class="hover:underline px-5 py-2 rounded-lg bold ">all professors</a>
    <a href="{{route("courses.index")}}" class=" hover:underline px-5 py-2 rounded-lg bold ">all courses</a>
    <a class=" hover:underline px-5 py-2 rounded-lg font-bold " href="/">about</a>



</nav>