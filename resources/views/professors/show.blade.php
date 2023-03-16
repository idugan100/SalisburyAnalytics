<x-header>
    <x-subHeader :title="'reviews for '.$professor->firstName . '-' . $professor->lastName"/>   
    <div class=" grid grid-cols-4">
        @if (count($professor->reviews)==0)
            <div class="flex justify-center col-start-2  text-lg">Sorry no reviews found for this professor</div>
        @endif
        <div class="col-start-2 col-span-2 mt-4">
            @foreach ($professor->reviews as $review)
                @if ($review->approved_flag==1)
                    <x-reviewCard :review="$review"></x-reviewCard>   
                @endif
            @endforeach
        </div>
        
    </div>
</x-header>
