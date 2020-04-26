<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ActorViewModel;
use App\ViewModels\ActorsViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularActors = Cache::remember('popularActors-'.$page, 1, function() use ($page)
        {

            return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/popular?page='.$page)->json()['results'];
        });


        $viewModel = new ActorsViewModel($popularActors, $page);

        return view('actors.index',$viewModel);
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
        $actor = Cache::remember('actor', 60, function ()
        {
            return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$this->id)->json();
        });

        $socail = Cache::remember('socail', 60, function ()
        {
            return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$this->id .'/external_ids')->json();
        });

        $credits = Cache::remember('credits', 60, function ()
        {
            return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$this->id .'/combined_credits')->json();
        });

        $viewModel = new ActorViewModel($actor, $socail, $credits);
        return view('actors.show',$viewModel);
    }


}
