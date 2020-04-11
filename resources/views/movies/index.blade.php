@extends('layouts.master')

@section('content')
    <div class="container px-4 pt-16 mx-auto">
        <div class="popular-movies">
            <h2 class="text-lg font-semibold tracking-wider text-orange-500 uppercase">popular movies</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach($popularMovies as $movie)
                <x-movie-card :movie="$movie"/>
                   
                @endforeach
            </div>
        </div>


        <div class="py-24 nowplaying-movies">
            <h2 class="text-lg font-semibold tracking-wider text-orange-500 uppercase">now Playing Movies</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach($nowPlayingMovies as $movie)
                    <x-movie-card :movie="$movie"/>
                    
                @endforeach
            </div>
        </div>
    </div>


@endsection
