<x-header>
    <x-subHeader title="all reviews"/>
    <div class="flex justify-center" >
        <div class="max-w-3xl p-6">
            <div class="flex justify-end">
                <a href="{{route("reviews.create")}}" class="m-2  border-4 border-yellow-400 hover:text-gray-300 bg-yellow-400 rounded font-bold px-1">+ add review</a>
            </div>
        @foreach ($reviews as $review)
        <x-reviewCard :review="$review"></x-reviewCard>   
        @endforeach
        </div>
    </div>

</x-header>