<ul class="nav flex-column">
    @foreach(\EmilMoe\Base\Menu::all() as $nav)
        <li class="nav-item">
            <a class="{{ in_array(Route::currentRouteName(), $nav->active) ? 'active' : '' }} nav-link d-flex align-items-center" href="{{ call_user_func_array($nav->link[0], $nav->link[1] ?? []) }}">
                {!! $nav->icon !!}
                <div>
                    {{ $nav->text }}
                </div>
            </a>
        </li>
    @endforeach
</ul>
<hr>
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#">
            <i class="material-icons">dashboard</i>
            <div>
                Forside
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="{{ Route::currentRouteName() === 'subscriptions.index' ? 'active' : '' }} nav-link d-flex align-items-center" href="{{ route('teams.index') }}">
            <i class="material-icons">attach_money</i>
            <div>
                Abonnementer
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="{{ Route::currentRouteName() === 'titles.index' ? 'active' : '' }} nav-link d-flex align-items-center" href="{{ route('teams.index') }}">
            <i class="material-icons">title</i>
            <div>
                Titler
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="{{ Route::currentRouteName() === 'files.index' ? 'active' : '' }} nav-link d-flex align-items-center" href="{{ route('teams.index') }}">
            <i class="material-icons">attach_file</i>
            <div>
                Filer
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="{{ Route::currentRouteName() === 'pivot.index' ? 'active' : '' }} nav-link d-flex align-items-center" href="{{ route('teams.index') }}">
            <i class="material-icons">crop_rotate</i>
            <div>
                Pivot
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#">
            <i class="material-icons">help</i>
            <div>
                Support
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#">
            <i class="material-icons">settings</i>
            <div>
                Indstillinger
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#">
            <i class="fas fa-directions"></i>
            <div>
                Roadmap
            </div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="#">
            <i class="material-icons">chat_bubble</i>
            <div>
                Support Center
                <span class="text-danger">•</span>
            </div>
        </a>
    </li>
</ul>