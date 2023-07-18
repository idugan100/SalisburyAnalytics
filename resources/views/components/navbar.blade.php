<nav class="p-3   text-xl font-sans font-bold px-5 py-2 rounded-lg flex justify-center md:justify-start flex-wrap ">
    @auth
        <a class=" decoration-yellow-500 decoration-4 hover:underline px-5 py-2 rounded-lg decoration-4 bold" href="{{route("courses.create")}}">new course</a>
        <a href="{{route("professors.create")}}" class="decoration-yellow-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">new professor</a> 
        <a href="{{route("reviews.processing")}}" class=" decoration-yellow-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">home</a> 

    @endauth
    <a href="{{route("reviews.index")}}" class=" inline-block decoration-yellow-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">all reviews</a>
    <a href="{{route("professors.index")}}" class=" inline-block decoration-yellow-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">all professors</a>
    <a href="{{route("courses.index")}}" class=" inline-block decoration-yellow-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">all courses</a>
    <a href="{{route("reviews.create")}}" class=" inline-block decoration-yellow-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">add review</a> 
    <a href="{{route("gpa")}}" class=" inline-block decoration-yellow-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">gpa tracker</a> 
    <a href="{{route("enrollment")}}" class=" inline-block decoration-yellow-500 decoration-4 hover:underline px-5 py-2 rounded-lg bold ">enrollment tracker</a> 
    <a href="/about" class=" inline-block hover:underline px-5 py-2 decoration-yellow-500 decoration-4 rounded-lg font-bold " >about</a>



</nav>