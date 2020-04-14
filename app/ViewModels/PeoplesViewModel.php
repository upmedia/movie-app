<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class PeoplesViewModel extends ViewModel
{
    public $popularPeoples;
    public $page;

    public function __construct($popularPeoples, $page)
    {
        $this->popularPeoples = $popularPeoples;
        $this->page = $page;
    }

    public function popularPeoples()
    {
        return collect($this->popularPeoples['results'])->map(function($person) {
            return collect($person)->merge([
                'profile_path' => $person['profile_path']
                    ? 'https://image.tmdb.org/t/p/w235_and_h235_face/' . $person['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name=' . $person['name'],
                'known_for' => collect($person['known_for'])->where('media_type', 'movie')->pluck('title')
                    ->union(collect($person['known_for'])->where('media_type', 'tv')->pluck('name'))->implode(', '),
            ])->only([
                'id', 'profile_path', 'name', 'known_for'
            ]);
        });
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < $this->popularPeoples['total_pages'] ? $this->page + 1 : null;
    }

}
