<x-header>
    <x-subHeader title="gpa tracker"/>
        <div class="m-5 border-solid border-yellow-500 p-4 border-4 rounded shadow">
            {{$gpa_chart->container()}}
        </div>
    </div>
</x-header>
<script src="{{$gpa_chart->cdn()}}"></script>
{{$gpa_chart->script()}}