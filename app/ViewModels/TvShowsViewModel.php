<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowsViewModel extends ViewModel
{
    public $popularTvShows;
    public $topRatedTvShows;
    public $genres;

    public function __construct($popularTvShows, $topRatedTvShows, $genres)
    {
        $this->popularTvShows   = $popularTvShows;
        $this->topRatedTvShows  = $topRatedTvShows;
        $this->genres           = $genres;
    }

    public function popularTvShows()
    {
        return $this->formatTvShows($this->popularTvShows);
    }

    public function topRatedTvShows()
    {
        return $this->formatTvShows($this->topRatedTvShows);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    public function formatTvShows($shows)
    {
        return collect($shows)->map(function($show) {
            $genresFormatted = collect($show['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($show)->merge([
                'poster_path'    => 'https://image.tmdb.org/t/p/w200' . $show['poster_path'],
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
                'vote_average'   => $show['vote_average'] * 10 . '%',
                'genres'         => $genresFormatted,
            ]);
        });
    }
}
