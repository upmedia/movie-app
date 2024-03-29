@extends('layout.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="w-full">
                <img src="{{ $tv['poster_path'] }}"
                    alt="{{ $tv['name'] }}"
                    title="{{ $tv['name'] }}"
                    class="w-32 sm:w-64 md:w-96"
                />
            </div>

            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $tv['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                    <span class="ml-1">{{ $tv['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $tv['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{ $tv['genres'] }}
                    </span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $tv['overview']}}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">
                        Created by
                    </h4>
                    <div class="flex mt-4">
                        @foreach ($tv['created_by'] as $person)
                            <div class="mr-8">
                                <div>{{ $person['name'] }}</div>
                                <!-- <div class="text-sm text-gray-400">
                                    {{ $person['id']}}
                                </div> -->
                            </div>
                        @endforeach
                    </div>
                </div>

                <div x-data="{ isOpen: false }">
                    @if (count($tv['videos']['results']) > 0)
                        <div class="mt-12">
                            <button
                                @click="isOpen = true"
                                class="flex inline-flex items-center bg-oran500 text-gray-500 rounded font-semibold px-5 py-4 text-gray-900 bg-orange-500 hover:bg-orange-600 transition ease-in-out duration-150"
                            >
                                <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>

                        <div
                            style="background-color: rgba(0,0,0,0.75)"
                            class="bg-black fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                            x-show.transition.opacity="isOpen"
                        >
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button
                                            class="text-3xl leadin-none hover:text-gray-300"
                                            @click="isOpen = false"
                                        >&times;</button>
                                    </div>

                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe width="560" height="315"
                                                class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                src="https://www.youtube.com/embed/{{ $tv['videos']['results'][0]['key'] }}"
                                                style="border: 0" allow="autoplay; encrypt-media" allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div><!-- end movie info -->

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>

            <div class="grid grid-col-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($tv['cast'] as $cast)
                    <div class="mt-8">
                        <a
                            href="{{ route('peoples.show', $cast['id']) }}"
                            class="relative block w-full h-100 overflow-hidden rounded shadow"
                        >
                            <img src="https://image.tmdb.org/t/p/w300{{ $cast['profile_path'] }}"
                                alt="{{ $cast['character'] }}"
                                class="transform hover:opacity-90 hover:scale-105 transition ease-in-out duration-150"
                            />
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('peoples.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                            <div class="text-sm text-gray-400">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div><!-- end movie-cast -->

    <div class="movie-images" x-data="{ isOpen: false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold mb-8">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach($tv['images'] as $image)
                    <div>
                        <a
                            href="#"
                            class="relative block w-full h-full overflow-hidden rounded shadow"
                            @click.prevent="
                                isOpen = true
                                image='{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}'
                            "
                        >
                            <img
                                src="https://image.tmdb.org/t/p/w300{{ $image['file_path'] }}"
                                alt="image"
                                class="transform hover:opacity-90 hover:scale-105 transition ease-in-out duration-150"
                            />
                        </a>
                    </div>
                @endforeach
            </div>

            <div
                style="background-color: rgba(0,0,0,0.75)"
                class="bg-black fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show.transition.opacity="isOpen"
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                                class="text-3xl leadin-none hover:text-gray-300"
                                @click="
                                    isOpen = false

                                "
                            >&times;</button>
                        </div>

                        <div class="modal-body px-8 py-8">
                            <img
                                :src="image"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end movie-images -->
@endsection
