<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
