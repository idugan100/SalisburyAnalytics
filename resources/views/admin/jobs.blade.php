<table>
    <thead>
        <th>Processes Running</th>
    </thead>
    @forelse($jobs as $job)
        <tr>
            <td>{{$job}}</td>
        </tr>  
    @empty
       <tr>
            <td>no processes running</td>
        </tr> 
    @endforelse
</table>