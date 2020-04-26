@extends('layouts.master')

@section('content')
    <div class="container px-4 pt-16 mx-auto">
        <div class="popular-actors">
            <h2 class="text-lg font-semibold tracking-wider text-orange-500 uppercase">popular Actors</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($actors as $actor)

                    <div class="mt-8 actor">
                        <a href="{{ route('actors.show',$actor['id']) }}">
                            <img src="{{ $actor['profile_path'] }}" class="transition duration-200 ease-in-out hover:opacity-75" alt="">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show',$actor['id']) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                            <div class="text-sm text-gray-400 truncate">
                                {{ $actor['known_for'] }}
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <div class="my-8 page-load-status">
            <div class="flex justify-center">
                <p class="my-8 text-4xl center infinite-scroll-request spinner">&nbsp;</p>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
          </div>
        {{--  <div class="flex justify-between mt-16 mb-16">
            @if($previous )
                <a href="/actors/page/{{ $previous }}">pervious</a>
            @else
                <div></div>
            @endif
            @if($next)
                <a href="/actors/page/{{ $next }}">Next</a>
            @else
                <div></div>
            @endif

        </div>  --}}
    </div>

@endsection
@section('scripts')
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    var elem = document.querySelector('.grid');
    var infScroll = new InfiniteScroll( elem, {

    path: '/actors/page/@{{#}}',
    append: '.actor',
    status: '.page-load-status'

    });

</script>
@endsection
