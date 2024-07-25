<x-header>
    <x-subHeader title="financial outcomes"/>
    <h3 class="text-center m-1">data on this page is specific to {{env("UNIVERSITY_NAME")}} graduates and is from the <a class="underline text-red-800" href="https://collegescorecard.ed.gov/data/documentation/" target="_blank">department of education</a> </h3>
    
    
    {{-- todo: add filter 
        <form class="flex justify-center mt-5">
        let's use htmx here  to my the filter dynamic
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
    </form> --}}

    <div class="flex justify-center mt-5 mx-2">
        <table class="border-collapse border-4  table-auto bg-white">
            <thead>
                <tr>
                    <th class="border-4 border-black bg-black text-white text-xs md:text-xl md:p-4" rowspan="2">progam name</th>
                    <th class="border-4 border-black bg-black text-white text-xs md:text-xl md:p-4" rowspan="2">degree level</th>
                    <th class="border-4 border-black bg-black text-white text-xs md:text-xl md:p-4" colspan="2">median income </th>
                    <th class="border-4 border-black bg-black text-white text-xs md:text-xl md:p-4" colspan="2">unemployment percentage</th>
                </tr>
                <tr>

                    <th class="border-4 border-black bg-black text-white text-xs md:text-sm ">year 1</th>
                    <th class="border-4 border-black  bg-black text-white text-xs md:text-sm ">year 4</th>
                    <th class="border-4 border-black bg-black text-white text-xs md:text-sm">year 1</th>
                    <th class="border-4 border-black bg-black text-white text-xs md:text-sm">year 4</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($outcomes as $outcome)
               <tr >
                    <td class="border-4 border-red-800  text-xs md:text-lg sm:p-4">{{$outcome->program_name}}</td>
                    <td class="border-4 border-red-800  text-xs md:text-lg sm:p-4">{{$outcome->credential_name}}</td>
                    <td class="border-4 border-red-800  text-xs md:text-lg sm:p-4">{{"$" . $outcome->median_income_year_1}}</td>
                    <td class="border-4 border-red-800  text-xs md:text-lg sm:p-4">{{"$" . $outcome->median_income_year_4}}</td>
                    <td class="border-4 border-red-800  text-xs md:text-lg sm:p-4">{{$outcome->year_one_unemployment() . "%"}}</td>
                    <td class="border-4 border-red-800  text-xs md:text-lg sm:p-4">{{$outcome->year_four_unemployment() . "%"}}</td>
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