<nav class="navbar navbar-light bg-white navbar-expand-md mb-4">
    <div class="container-fluid offset-xl-1 col-xl-10">
        <div>
            {{-- Collapse/Expand button for mobile --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Logo --}}
            <span class="navbar-brand mb-0 h1">
                <img src="{{ config('app.logo') }}" alt="">
            </span>
        </div>

        {{-- Avatar on mobile --}}
        <div class="nav-item dropdown my-2 my-lg-0 d-block d-md-none">
            @include('EmilMoe\Base::admin.user-menu')
        </div>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto mt-lg-0 d-md-none">
                @foreach(\EmilMoe\Base\Menu::all() as $nav)
                    <li class="nav-item">
                        <a class="{{ in_array(Route::currentRouteName(), $nav->active) ? 'active' : '' }} nav-link" href="{{ call_user_func_array($nav->link[0], $nav->link[1] ?? []) }}">
                            {!! $nav->icon !!}
                            <p>
                                {{ $nav->text }}
                            </p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Avatar on desktop --}}
        <div class="nav-item dropdown my-2 my-lg-0 d-none d-md-block">
            @include('EmilMoe\Base::admin.user-menu')
        </div>
    </div>
</nav>
