<x-header>
    <x-subHeader title="the pitch"/>
<div class="m-4">
    <div class="flex flex-col items-center justify-center">
        <div>
            <h2 class="text-3xl m-3 bold">want to know ....</h2>
            <div class="border border-black m-3 bg-white p-2 rounded">
                <h3 class="text-2xl {{env("MAIN_BG")}} p-1 rounded">which professor is the easiest?</h3>
                <div class="flex flex-col items-center">
                    <h3 class="text-xl">checkout our data explorer</h3>
                    <img src="{{URL::asset('query_tool.png')}}" height="400" width="400">
                </div>
            </div>
            <div class="border border-black m-3 bg-white p-2 rounded">
                <h3 class="text-2xl {{env("MAIN_BG")}} p-1 rounded">what major makes the most money?</h3>
                <div class="flex flex-col items-center">
                    <h3 class="text-xl">checkout our financial outcomes dashboard</h3>
                    <img src="{{ URL::asset('financial_outcomes.png') }}" height="400" width="400">
                </div>
            </div>
            <div class="border border-black m-3 bg-white p-2 rounded">
                <h3 class="text-2xl {{env("MAIN_BG")}} p-1 rounded">what grades your classmates got?</h3>
                <div class="flex flex-col items-center">
                    <h3 class="text-xl">checkout our grade distributions</h3>
                    <img src="{{ URL::asset('distribution.png') }}" height="400" width="400">
                </div>
            </div>
            <div class="border border-black m-3 bg-white p-2 rounded">
                <h3 class="text-2xl {{env("MAIN_BG")}} p-1 rounded">which major is the easiest?</h3>
                <div class="flex flex-col items-center">
                    <h3 class="text-xl">checkout our major gpa tracker</h3>
                    <img src="{{ URL::asset('gpa_report.png') }}" height="400" width="400">
                </div>
            </div>
            <div class="border border-black m-3 bg-white p-2 rounded flex flex-col items-center">
                <p class="text-2xl m-1 {{env("ACCENT_TEXT_COLOR")}}">College is a time of decisions.</p>
                <p class="text-2xl m-1 {{env("ACCENT_TEXT_COLOR")}}">Decisions about courses, professors, majors and more.</p>
                <p class="text-2xl m-1 {{env("ACCENT_TEXT_COLOR")}}">We have the data you need to make these decisions.</p>
                <a href="{{route("register")}}" class="{{env("ACCENT_BG")}} w-96 p-3 m-2 rounded text-white font-bold flex justify-center">click here for a trial</a>

            </div>
        </div>
       


    </div>
   <div class="flex justify-center m-2">
   </div>

</div>
</x-header>