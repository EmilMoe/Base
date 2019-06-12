<nav class="navbar navbar-light bg-white mb-5">
    <div class="container-fluid offset-xl-1 col-xl-8">
        <span class="navbar-brand mb-0 h1">
            @if(file_exists(public_path(config('base.logo'))))
                <img src="{{ url(config('base.logo')) }}" alt="">
            @else
                {{ env('APP_NAME') }}
            @endif
        </span>
    </div>
</nav>