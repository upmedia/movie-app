<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvShowsViewModel;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularTvShows = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . 'tv/popular')
            ->json()['results'];

        $topRatedTvShows = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . 'tv/top_rated')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . 'genre/tv/list')
            ->json()['genres'];

        $viewModel = new TvShowsViewModel(
            $popularTvShows,
            $topRatedTvShows,
            $genres
        );
        return view('tvshows.index', $viewModel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $tvShow = Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . 'tv/' . $id . '?append_to_response=credits,videos,images,episodes,seasons')
            ->json();

        // dump($tvShow);

        $viewModel = new TvShowViewModel($tvShow);

        return view('tvshows.show', $viewModel);
    }
}
