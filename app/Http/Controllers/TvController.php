<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\TvViewModel;
use App\ViewModels\TvsViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularTv = Cache::remember('popularTv', 60, function () {
            return Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/tv/popular')->json()['results'];
        });
        $topRetedTv = Cache::remember('nowPlayingMovies', 60, function () {
            return Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/tv/top_rated')->json()['results'];
        });
        $genres = Cache::remember('genresArray', 60, function () {
            return Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3//genre/movie/list')->json()['genres'];
        });

        $viewModel = new TvsViewModel($popularTv,$topRetedTv,$genres);
        return view('tv.index',$viewModel);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->id = $id;
        $tv = Cache::remember('tv', 60, function () {
            return   Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/'.$this->id.'?append_to_response=credits,videos,images')->json();
        });

        $viewModel = new TvViewModel($tv);
        return view('tv.show',$viewModel);
    }


}
