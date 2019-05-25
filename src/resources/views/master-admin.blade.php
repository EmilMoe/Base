<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link xmlns="https://www.w3.org/1999/xhtml" rel="shortcut icon" href="{{ url('images/logo.svg') }}">
        <link rel="manifest" href="{{ url('mix-manifest.json') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <title>{{ isset($pagename) ? $pagename : config('app.name') }}</title>

        <link href="{{ url(mix('css/app.css')) }}" rel="stylesheet">
    </head>
    <body class="{{ $class['body'] ?? '' }}">
        <div id="app" v-cloak>
            @if(View::exists('EmilMoe\Navigation::left'))
                @if(! isset($menu) || $menu === true)
                    @include('EmilMoe\Navigation::left')
                @endif
            @endif

            @if(View::exists('EmilMoe\Navigation::top'))
                @if (! isset($menu) || $menu === true)
                    @include('EmilMoe\Navigation::top', ['logo' => \EmilMoe\Base\App::getInstance()->getLogo()])
                @endif
            @endif

            <main>
                @yield('page')
            </main>
            
            <footer>
            </footer>
        </div>

        <script>
            window.Laravel = <?php echo json_encode(array_merge([
                'baseUrl'   => url('/'),
                'locale'    => config('app.locale'),
            ], env('APP_DEBUG') ? ['debug' => true] : [])); ?>
        </script>
        @yield('script')
        <script src="//cdn.polyfill.io/v2/polyfill.min.js"></script>
        <script src="{{ url(mix('js/app.js')) }}"></script>
    </body>
</html>