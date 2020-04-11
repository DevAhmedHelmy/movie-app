@extends('layouts.master')

@section('content')
    <div class="container px-4 pt-16 mx-auto">
        <div class="popular-movies">
            <h2 class="text-lg font-semibold tracking-wider text-orange-500 uppercase">popular movies</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach($popularMovies as $movie)
                {{--  <x-movie-card :movie="$movie" :genres="$genres"/>  --}}
                    <div class="mt-8">
                        <a href="{{ route('movies.show',$movie['id']) }}">
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" class="transition duration-150 ease-in-out hover:opacity-75" alt="">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('movies.show',$movie['id']) }}" class="mt-2 text-lg hover:text-gray-300">{{ $movie['title'] }}</a>
                            <div class="flex items-center mt-1 text-sm text-gray-400">
                                <span>star </span>
                                <span class="ml-1">{{ $movie['vote_average'] * 10 .'%' }}</span>
                                <span class="mx-2">| </span>
                                <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                            </div>
                            <div class="text-sm text-gray-400">@foreach($movie['genre_ids'] as $value){{ $genres[$value] }}@if(!$loop->last),@endif @endforeach</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="py-24 nowplaying-movies">
            <h2 class="text-lg font-semibold tracking-wider text-orange-500 uppercase">now Playing Movies</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach($nowPlayingMovies as $movie)
                    {{--  <x-movie-card :movie="$movie" :genres="$genres"/>  --}}
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
                            <div class="text-sm text-gray-400">@foreach($movie['genre_ids'] as $value){{ $genres[$value] }}@if(!$loop->last),@endif @endforeach</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection
