@extends('layouts.master')

@section('content')
    <div class="container px-4 pt-16 mx-auto">
        <div class="popular-actors">
            <h2 class="text-lg font-semibold tracking-wider text-orange-500 uppercase">popular Actors</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($actors as $actor)

                    <div class="mt-8 actor">
                        <a href="#">
                            <img src="{{ $actor['profile_path'] }}" class="transition duration-200 ease-in-out hover:opacity-75" alt="">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                            <div class="text-sm text-gray-400 truncate">
                                {{ $actor['known_for'] }}
                            </div>
                        </div>
                    </div>

                @endforeach
        </div>
        </div>
    </div>

@endsection
