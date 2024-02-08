<x-header>
    <x-subHeader title="student demographics"/>
    <div class="m-5 border-solid border-black p-4 border-4 rounded shadow" style="height: 350px;" >
        <div id="GPAchart">
            {{$ethnicity_chart->container()}}
            <script src="{{$ethnicity_chart->cdn()}}"></script>
            {{$ethnicity_chart->script()}}
        </div>
    </div>
</x-header>