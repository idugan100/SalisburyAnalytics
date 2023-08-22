<x-header>
    <x-subHeader title="all reviews"/>
    <div class="flex justify-center" >
        <div class="max-w-3xl p-6">
            <div class="flex justify-end">
                <a href="{{route("reviews.create")}}" class="m-2  border-4 border-yellow-500 hover:text-gray-300 bg-yellow-500 rounded font-bold px-1">+ add</a>
            </div>
        @foreach ($reviews as $review)
        <x-reviewCard :review="$review"></x-reviewCard>   
        @endforeach
        </div>
    </div>

</x-header>