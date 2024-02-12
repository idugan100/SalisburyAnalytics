<x-header>
    <x-subHeader title="student demographics"/>
    <h3 class="text-center m-1">data on this page is from the <a class="underline text-red-800" href="https://collegescorecard.ed.gov/data/documentation/" target="_blank">department of education</a> </h3>
    <div class="bg-white m-5 border-solid border-black p-4 border-4 rounded shadow" style="height: 350px;" >
        <div id="GPAchart">
            {{$ethnicity_chart->container()}}
            <script src="{{$ethnicity_chart->cdn()}}"></script>
            {{$ethnicity_chart->script()}}
        </div>
    </div>

    <div class="grid md:grid-cols-3">
        <span id="GenderChart"  class = " bg-white mx-5 my-2 border-solid border-black border-4 rounded">
            {{$gender_chart->container()}}
            {{$gender_chart->script()}}
        </span>
        
        <span id="ParentEducationChart"  class = "bg-white mx-5 my-2 border-solid border-black border-4 rounded">
            {{$parent_education->container()}}
            {{$parent_education->script()}}
        </span>
        <span id="EnrollmentTypeChart"  class = "bg-white mx-5 my-2 border-solid border-black border-4 rounded">
            {{$enrollment_type->container()}}
            {{$enrollment_type->script()}}
        </span>
    </div>

    <div class=" bg-white m-5 border-solid border-black p-4 border-4 rounded" style="height: 300px;" >
        <div id="IncomeChart">
            {{$income->container()}}
            {{$income->script()}}
        </div>
    </div>


</x-header>