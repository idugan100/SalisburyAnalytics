<x-header>
    <x-subHeader title="financial outcomes"/>
    <h3 class="text-center m-1">data on this page is from the <a class="underline text-red-800" href="https://collegescorecard.ed.gov/data/documentation/" target="_blank">department of education</a> </h3>
    
    
    <form class="flex justify-center mt-5">
        {{-- let's use htmx here  to my the filter dynamic --}}
        <select name="" id="">
            <option value="">Median Income 1 Year after graduation</option>
            <option value="">Median Income 4 Years after graduation</option>
            <option value="">Unemployment Percentage after 1 year</option>
            <option value="">Unemployment Percentage after 4 years</option>
        </select>
        <select name="" id="">
            <option value="">asc</option>
            <option value="">desc</option>
        </select>
    </form>

    <div class="flex justify-center mt-5">
        <table class="border-collapse border-4 border-red-800 table-auto">
            <thead>
                <tr>
                    <th class="border-4 border-red-800 p-3">Progam Name</th>
                    <th class="border-4 border-red-800 p-3">Degree Level</th>
                    <th class="border-4 border-red-800 p-3">Median Income 1 Year after graduation</th>
                    <th class="border-4 border-red-800 p-3">Median Income 4 Years after graduation</th>
                    <th class="border-4 border-red-800 p-3">Unemployment Percentage after 1 year</th>
                    <th class="border-4 border-red-800 p-3">Unemployment Percentage after 4 years</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($outcomes as $outcome)
               <tr>
                    <td class="border-4 border-red-800 p-3">{{$outcome->program_name}}</td>
                    <td class="border-4 border-red-800 p-3">{{$outcome->credential_name}}</td>
                    <td class="border-4 border-red-800 p-3">{{"$" . $outcome->median_income_year_1}}</td>
                    <td class="border-4 border-red-800 p-3">{{"$" . $outcome->median_income_year_4}}</td>
                    <td class="border-4 border-red-800 p-3">{{$outcome->unemployment_pct_year_1 . "%"}}</td>
                    <td class="border-4 border-red-800 p-3">{{$outcome->unemployment_pct_year_4 . "%"}}</td>
                </tr> 
            @empty
            <tr>
                <td class="border-4 border-red-800">no data found</td>
            </tr>
            @endforelse
            </tbody>
            
        </table>
    </div>
    
</x-header>