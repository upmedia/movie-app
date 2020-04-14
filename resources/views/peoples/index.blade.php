@extends('layout.main')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-peoples">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Popular Peoples
            </h2>
            <div class="grid grid-col-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularPeoples as $person)
                    <div class="people mt-8">
                        <a href="{{ route('peoples.show', ['person' => $person['id']]) }}" class="block w-full h-100 overflow-hidden rounded shadow">
                            <img src="{{ $person['profile_path'] }}"
                                alt="{{ $person['name'] }}"
                                title="{{ $person['name'] }}"
                                class="transform hover:opacity-90 hover:scale-105 transition ease-in-out duration-150"
                            />
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('peoples.show', $person['id']) }}" class="text-lg hover:text-gray-300">
                                {{ $person['name'] }}
                            </a>
                            <div class="text-sm truncate text-gray-400">
                                {{ $person['known_for'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
        </div>

        <!-- <div class="flex justify-between mt-16">
            <div>
                @if ($previous)
                    <a href="{{ route('peoples.pagination', ['page' => $previous ]) }}">Previous</a>
                @endif
            </div>
            <div>
                @if ($next)
                    <a class="pagination__next" href="{{ route('peoples.pagination', ['page' => $next ]) }}">Next</a>
                @endif
            </div>
        </div> -->
    </div>
@endsection

@section('scripts')
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    var elem = document.querySelector('.grid');
    var infScroll = new InfiniteScroll( elem, {
        // options
        path: '/peoples/page/@{{#}}',
        append: '.people',
        status: '.page-load-status'
        // history: true,
    });

</script>
@endsection
