<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="bg-gray-800 w-64 px-4 py-1 pl-8 rounded-full focus:outline-none focus:shadow-outline text-sm"
        placeholder="Search"
        x-ref="search"
        @keydown.window="
            if (event.keyCode == 191) {
                event.preventDefaul();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    />
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>

    @if (strlen($search) >= 2)
        <div
            class="absolute bg-gray-800 rounded w-64 mt-4 z-50"
            x-show.transition.opacity="isOpen"
        >
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            @if ($result['media_type'] == 'movie')
                                <a
                                    href="{{ route('movies.show', $result['id']) }}"
                                    class="block hover:bg-gray-700 transition ease-out duration-150 px-3 py-3 text-sm flex items-center"
                                    @if($loop->last) @keydown.tab="isOpen = false" @endif
                                >
                                    @if ($result['poster_path'])
                                        <img
                                            src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}"
                                            alt="{{ $result['title'] }}"
                                            class="w-8"
                                        >
                                    @else
                                        <img
                                            src="https://via.placeholder.com/50x75"
                                            class="w-8"
                                        >
                                    @endif

                                    <span class="ml-4">
                                         {{ $result['title'] }}
                                    </span>
                                </a>
                            @elseif ($result['media_type'] == 'tv')
                                <a
                                    href="{{ route('tvshows.show', $result['id']) }}"
                                    class="block hover:bg-gray-700 transition ease-out duration-150 px-3 py-3 text-sm flex items-center"
                                    @if($loop->last) @keydown.tab="isOpen = false" @endif
                                >
                                    @if ($result['poster_path'])
                                        <img
                                            src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}"
                                            alt="{{ $result['name'] }}"
                                            class="w-8"
                                        >
                                    @else
                                        <img
                                            src="https://via.placeholder.com/50x75"
                                            class="w-8"
                                        >
                                    @endif

                                    <span class="ml-4">
                                        {{ $result['name'] }}
                                    </span>
                                </a>
                            @elseif ($result['media_type'] == 'person')
                                <a
                                    href="{{ route('peoples.show', $result['id']) }}"
                                    class="block hover:bg-gray-700 transition ease-out duration-150 px-3 py-3 text-sm flex items-center"
                                    @if($loop->last) @keydown.tab="isOpen = false" @endif
                                >
                                    @if ($result['profile_path'])
                                        <img
                                            src="https://image.tmdb.org/t/p/w92/{{ $result['profile_path'] }}"
                                            alt="{{ $result['name'] }}"
                                            class="w-8"
                                        >
                                    @else
                                        <img
                                            src="https://via.placeholder.com/50x75"
                                            class="w-8"
                                        >
                                    @endif

                                    <span class="ml-4">
                                        {{ $result['name'] }}
                                    </span>
                                </a>
                            @endif
                        </li>

                    @endforeach
                </ul>
            @else
                <div class="p-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>
