<nav class="p-3   text-xl font-sans font-bold px-5 py-2 rounded-lg">
    @auth
        <a class=" decoration-sky-500 decoration-4 hover:underline px-5 py-2 rounded-lg decoration-blue-400 bold" href="{{route("courses.create")}}">new course</a>
        <a href="{{route("professors.create")}}" class="decoration-sky-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">new professor</a> 
        <a href="{{route("reviews.processing")}}" class=" decoration-sky-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">home</a> 

    @endauth
    <a href="{{route("reviews.index")}}" class=" decoration-sky-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">all reviews</a>
    <a href="{{route("professors.index")}}" class="decoration-sky-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">all professors</a>
    <a href="{{route("courses.index")}}" class="decoration-sky-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">all courses</a>
    <a href="{{route("reviews.create")}}" class=" decoration-sky-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">add review</a> 
    <a class=" hover:underline px-5 py-2 decoration-sky-500 decoration-4 rounded-lg font-bold " href="/">about</a>



</nav>