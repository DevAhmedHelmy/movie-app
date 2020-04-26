@extends('layouts.master')

@section('content')
    <div class="container px-4 pt-16 mx-auto">
        <div class="popular-tv">
            <h2 class="text-lg font-semibold tracking-wider text-orange-500 uppercase">popular shows</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach($popularTv as $tv)
                <x-tv-card :tv="$tv"/>

                @endforeach
            </div>
        </div>


        <div class="py-24 top_related_shows">
            <h2 class="text-lg font-semibold tracking-wider text-orange-500 uppercase">top related shows</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach($topRetedTv as $tv)
                <x-tv-card :tv="$tv"/>

                @endforeach
            </div>
        </div>
    </div>


@endsection
