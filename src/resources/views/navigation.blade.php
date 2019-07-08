<ul class="nav d-none d-md-block">
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
