<x-header>
<h2>Add a course</h2>
<form method="POST" action="{{route('courses.store')}}">
    @csrf
   
    <div>
        <label>Department Code</label>
        <input name="departmentCode" type="text">
    </div>
    <div>
        <label>Course Number</label>
        <input name="courseNumber" type="text">
    </div>
    <label>Course Description</label>

    <div>
        <textarea name="description" cols="30" rows="10"></textarea>
    </div>
    <div>
        <label>Syllabus Link</label>
        <input name="syllabusLink" type="text">
    </div>
    <div>
        <label>Lab Hours Per Week</label>
        <input name="creditsLab" type="number">
    </div>
    <div>
        <label>Lecture Hours Per Week</label>
        <input name="creditsLecture" type="number">
    </div>
    <div>
        <label>Credit Hours</label>
        <input name="creditsTotal" type="number">
    </div>
    <button type="submit">Submit</button>
</form>
</x-header>