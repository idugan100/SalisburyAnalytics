<x-header>
<x-subHeader :title="$course->departmentCode . '-' . $course->courseNumber . ' times'"/>
    <div class="p-6 space-y-6 flex justify-center ">
        <iframe loading="lazy" src="{{"https://www.coursicle.com/salisbury/#search=".$course->departmentCode."+" . $course->courseNumber}}"  height="700" width="1250"></iframe>
    </div>
</x-header>