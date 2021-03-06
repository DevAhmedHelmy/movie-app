<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Cache::remember('popularMovies', 60, function () {
            return  Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')->json()['results'];
        });

        $nowPlayingMovies = Cache::remember('nowPlayingMovies', 60, function () {
            return  Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')->json()['results'];
        });
        $genres = Cache::remember('genresArray', 60, function () {
            return  Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3//genre/movie/list')->json()['genres'];
        });

        $viewModel = new MoviesViewModel(
            $popularMovies,$nowPlayingMovies,$genres
        );
        return view('movies.index',$viewModel);
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
        $movie = Cache::remember('movie', 60, function () {
            return   Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'.$this->id.'?append_to_response=credits,videos,images')->json();
        });
        $viewModel = new MovieViewModel($movie);
        return view('movies.show',$viewModel);

    }


}
