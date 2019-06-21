<nav class="navbar navbar-light bg-white navbar-expand-lg mb-5">
    <div class="container-fluid offset-xl-1 col-xl-10">
        <div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <span class="navbar-brand mb-0 h1">
            @if(file_exists(public_path(config('base.logo'))))
                    <img src="{{ url(config('base.logo')) }}" alt="">
                @else
                    {{ env('APP_NAME') }}
                @endif
            </span>
        </div>

        <div class="nav-item dropdown my-2 my-lg-0 d-block d-sm-none">
            <a class="nav-link p-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <avatar :size="40" username="Emil Moe"></avatar>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('users.show', auth()->id()) }}">Indstillinger</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">Logud</a>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto mt-lg-0">

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

        <div class="nav-item dropdown my-2 my-lg-0 d-none d-md-block">
            <a class="nav-link p-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <avatar :size="40" username="Emil Moe"></avatar>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('users.show', auth()->id()) }}">
                    <i class="fas fa-user-cog"></i>
                    Indstillinger
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt"></i>
                    Logud
                </a>
            </div>
        </div>
    </div>
</nav>
