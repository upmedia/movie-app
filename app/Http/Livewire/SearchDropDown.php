<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropDown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = collect();

        if (strlen($this->search) >= 2) {
            $searchResults = collect(Http::withToken(config('services.tmdb.token'))
            ->get(config('services.tmdb.base_url') . 'search/movie?query=' . $this->search)
            ->json()['results'])->take(7);
        }

        // dd($searchResults);

        return view('livewire.search-drop-down', compact(
            'searchResults'
        ));
    }
}
