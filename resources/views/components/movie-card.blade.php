<div class="mt-8">
    <a href="#">
        <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" class="transition duration-150 ease-in-out hover:opacity-75" alt="">
    </a>
    <div class="mt-2">
        <a href="#" class="mt-2 text-lg hover:text-gray-300">{{ $movie['title'] }}</a>
        <div class="flex items-center mt-1 text-sm text-gray-400">
            <span>star </span>
            <span class="ml-1">{{ $movie['vote_average'] * 10 .'%' }}</span>
            <span class="mx-2">| </span>
            <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
        </div>
        <div class="text-sm text-gray-400">
            @foreach($movie['genre_ids'] as $value)
                {{ $genres[$value] }}@if(!$loop->last), @endif
            @endforeach
        </div>
    </div>
</div>
