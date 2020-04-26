<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TvsViewModel extends ViewModel
{
    public $popularTv;
    public $topRetedTv;
    public $genres;
    public function __construct($popularTv,$topRetedTv,$genres)
    {
        $this->popularTv    = $popularTv;
        $this->topRetedTv   = $topRetedTv;
        $this->genres       = $genres;
    }
    public function popularTv()
    {
        return $this->formatTv($this->popularTv);
    }
    public function topRetedTv()
    {
        return $this->formatTv($this->topRetedTv);
    }
    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });
    }


    private function formatTv($tvs)
    {


        return collect($tvs)->map(function($tv){

            return collect($tv)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$tv['poster_path'],
                "vote_average" => $tv['vote_average'] * 10 .'%',
                "first_air_date" => \Carbon\Carbon::parse($tv['first_air_date'])->format('M d, Y'),
                'genres' => $this->genresFormatted($tv)

            ])->only(
                'poster_path','vote_average','first_air_date','genres','id','name','overview','genre_ids'
            );
        });
    }
    private function genresFormatted($tv)
    {
        return collect($tv['genre_ids'])->mapWithKeys(function($value){
            return [$value => $this->genres()->get($value)];
        })->implode(', ');
    }
}
