<x-header>
    <x-subHeader title="user details"/>
    @if (count($user_details)>0)
    <table class=" m-4 table-fixed border-collapse border border-blue-400">
        <thead >
            <tr>
              <th class="text-white bg-black border-2 border-red-800">Date</th>
              <th class="text-white bg-black border-2 border-red-800">Agent</th>
              <th class="text-white bg-black border-2 border-red-800">Ip Address</th>
              <th class="text-white bg-black border-2 border-red-800">Page</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user_details as $detail)
            <tr>
                <td class=" p-2 border-2 border-red-800">{{$detail->created_at}}</td>
                <td class=" p-2 border-2 border-red-800">{{$detail->user_agent}}</td>
                <td class=" p-2 border-2 border-red-800">{{$detail->ip_address}}</td>
                <td class=" p-2 border-2 border-red-800">{{$detail->page_visited}}</td>
            </tr>
                
            @endforeach
          </tbody>
        </table>  
    @else
        <div class="flex justify-center m-3">
            <div>No User Details</div>
        </div>
    @endif
   

</x-header>