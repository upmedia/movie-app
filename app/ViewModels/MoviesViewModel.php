<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;

    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {
        $this->popularMovies    = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres           = $genres;
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovies($movies)
    {
        return collect($movies)->map(function($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            dd($movie);

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w200' . $movie['poster_path'],
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'genres' => $genresFormatted,
            ])->only([
                'id',
                'title',
                'title',
                'genres',
                'overview',
                'poster_path',
                'vote_average',
                'release_date',
            ]);
        });
    }
}
