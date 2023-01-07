<nav class="p-3 bg-gray-500 text-white">
    @auth
        <a class="bg-red-900 p-1 rounded" href="{{route("courses.create")}}">New Course</a>
        <a href="{{route("professors.create")}}" class="bg-red-900 p-1 rounded">New Professor</a> 
    @endauth
    <a href="{{route("professors.index")}}" class="bg-red-900 p-1 rounded">All Professors</a>
    <a href="{{route("courses.index")}}" class="bg-red-900 p-1 rounded">All Courses</a>
    <a class="bg-red-900 p-1 rounded" href="/">About</a>



</nav>