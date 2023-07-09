<x-header>
    <x-subHeader title="all reviews"/>
    <div class="flex justify-center" >
        <div class="max-w-3xl p-6">
        @foreach ($reviews as $review)
        <x-reviewCard :review="$review"></x-reviewCard>   
        @endforeach
        </div>
    </div>

</x-header>