@extends('layouts.master')

@section('content')
    <div class="border-b border-gray-800 tv-info">
        <div class="container flex flex-col px-4 py-16 mx-auto md:flex-row">
            <img src="{{ $tv['poster_path'] }}" class="w-64 transition duration-150 ease-in-out hover:opacity-75 md:w-96" alt="">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $tv['name'] }}</h2>
                <div class="flex flex-wrap items-center text-sm text-gray-400">
                    <svg class="w-4 text-orange-500 fill-current" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                    <span class="ml-1">{{ $tv['vote_average']}}</span>
                    <span class="mx-2">| </span>
                    <span>{{ $tv['first_air_date']}}</span>
                    <span class="mx-2">| </span>
                    <span> {{ $tv['genres']}} </span>
                </div>
                <p class="mt-8 text-gray-300">
                    {{ $tv['overview'] }}
                </p>
                <div class="mt-12">
                    <h4 class="font-semibold text-white">Featured Cast</h4>
                    <div class="flex mt-4">
                        @foreach($tv['created_by'] as $crew)

                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">Creator</div>
                            </div>

                        @endforeach



                    </div>
                </div>
                <div x-data="{isOpen:false}">
                    @if($tv['videos']['results'] > 0)
                        <div class="mt-12">
                            <button
                            @click="isOpen=true"
                             href="https://youtube.com/watch?v={{ $tv['videos']['results'][0]['key'] }}" class="flex inline-flex items-center px-5 py-4 font-semibold text-gray-900 transition duration-200 ease-in-out bg-orange-500 rounded hover:bg-orange-800">
                                <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                    @endif
                    <div style="background-color: rgba(0, 0, 0, .5);"
                        class="fixed top-0 left-0 flex items-center w-full h-full overflow-y-auto shadow-lg"
                        x-show.transition.opacity="isOpen">
                        <div class="container mx-auto overflow-y-auto rounded-lg lg:px-32">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pt-2 pr-4">
                                    <button
                                        @click="isOpen=false"
                                        class="text-3xl leading-none hover:text-gray-300">&times;
                                    </button>
                                </div>
                                <div class="px-8 py-8 modal-body">
                                    <div class="relative overflow-hidden responsive-container" style="padding-top: 56.25%">
                                        <iframe class="absolute top-0 left-0 w-full h-full responsive-iframe" src="https://www.youtube.com/embed/{{ $tv['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- end info --}}

    <div class="border-b border-gray-800 tv-cast">
        <div class="container px-4 py-16 mx-auto">
            <h2 class="px-4 py-16 mx-auto text-4xl">casts</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach($tv['cast'] as $cast)

                    <div class="mt-8">
                        <a href="{{ route('actors.show',$cast['id']) }}">
                            <img src="{{ 'https://image.tmdb.org/t/p/w300/'.$cast['profile_path'] }}" class="transition duration-150 ease-in-out hover:opacity-75" alt="">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show',$cast['id']) }}" class="mt-2 text-lg hover:text-gray-300">{{ $cast['name'] }}</a>
                            <div class="flex items-center mt-1 text-sm text-gray-400">
                                {{ $cast['character'] }}
                            </div>

                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
    {{--  tv images  --}}
    <div class="tv-images" x-data="{ isOpen: false, image: ''}">
        <div class="container px-4 py-16 mx-auto">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($tv['images'] as $image)

                    <div class="mt-8">
                        <a
                            @click.prevent="
                                isOpen = true
                                image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                            "
                            href="#"
                        >
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="image1" class="transition duration-150 ease-in-out hover:opacity-75">
                        </a>
                    </div>

                @endforeach
            </div>

            <div
                style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 flex items-center w-full h-full overflow-y-auto shadow-lg"
                x-show="isOpen"
            >
                <div class="container mx-auto overflow-y-auto rounded-lg lg:px-32">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pt-2 pr-4">
                            <button
                                @click="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="px-8 py-8 modal-body">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end tv-images -->
@endsection
