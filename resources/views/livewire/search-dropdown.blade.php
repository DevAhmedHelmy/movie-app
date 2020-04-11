<div class="relative md:ml-4 md:mt-0" x-data="{isOpen:true}" @click.away="isOpen=false">
    <input
        wire:model="search"
        type="text" class="w-64 px-2 py-2 pl-8 text-sm bg-gray-800 rounded-full focus:outline-none focus:shadow-outline"
        placeholder="Search"
        x-ref="search"
        @keydown.window="
            if (event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen=true"
        @keydown="isOpen=true"
        @keydown.escape.window="isOpen-false"
        @keydown.shft.tap="isOpen=false"
        >
    <div class="absolute top-0">
        <svg class="inline w-4 h-4 mt-3 ml-2 pointer-events-none fill-current text-grey-darkest" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
          </svg>
    </div>
    <div wire:loading class="top-0 right-0 mt-4 mr-4 spinner"></div>
    @if(strlen($search) >= 2)
        <div class="absolute z-50 w-64 mt-4 text-sm bg-gray-800 rounded"
            x-show.transition.opacity="isOpen"
            >
            @if(count($searchResults) > 0)
                <ul>

                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-800">
                            <a href="{{ route('movies.show',$result['id']) }}" class="flex items-center block px-3 py-3 hover:bg-gray-700"
                            @if($loop->last)@keydown.tab.exact="isOpen=false"@endif
                            >
                                @if($result['poster_path'])
                                    <img src="{{ 'https://image.tmdb.org/t/p/w92/'.$result['poster_path'] }}" class="w-4 border" alt="poster_path">
                                @else
                                    <img src="https://via.placeholer.com/50*75" alt="poster" class="w-4">
                                @endif

                                <span class="ml-4">{{ $result['title'] }}</span>

                            </a>
                        </li>
                    @endforeach


                </ul>
            @else
                <div class="px-3 py-3 border-b border-gray-800">No Result For {{ $search }}</div>
            @endif
        </div>
    @endif
</div>
