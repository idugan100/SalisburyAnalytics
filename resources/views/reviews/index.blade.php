<x-header>
    <x-subHeader title="all reviews"/>
    <div class="grid grid-cols-3">
        <div class="col-start-2">
        @foreach ($reviews as $review)
        <x-reviewCard :review="$review"></x-reviewCard>   
        @endforeach
        </div>
    </div>

</x-header>