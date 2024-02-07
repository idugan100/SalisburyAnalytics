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
    <div class="mt-4 flex p-4 justify-end">
        @if (!$reviews->onFirstPage())
            <a href="{{$reviews->previousPageUrl()}}" class="m-2">Previous</a>
        @endif
        @if($reviews->hasMorePages())
            <a href="{{$reviews->nextPageUrl()}}" class="m-2">Next </a>
        @endif
    </div>

</x-header>