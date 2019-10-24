<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link xmlns="https://www.w3.org/1999/xhtml" rel="shortcut icon" href="">
        <link rel="manifest" href="{{ url('mix-manifest.json') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="{{ url(mix('css/app.css')) }}" rel="stylesheet">
        <title>{{ isset($pagename) ? $pagename : config('app.name') }}</title>
    </head>
    <body class="{{ $class['body'] ?? '' }}">
        @yield('site')
        <script>
            window.Laravel = <?php echo json_encode(array_merge(array_merge([
                'baseUrl'   => url('/'),
                'locale'    => \Illuminate\Support\Facades\App::getLocale(),
            ], env('APP_DEBUG') ? ['debug' => true] : [])
            , ! \Auth::user() ? [] : [
                'user' => [
                    'id' => \Auth::id(),
                    'permissions' => call_user_func(config('base.permission_keys_callback'), Auth::user()) ?? [],
                    'admin' => \Auth::user()->{config('base.admin_attribute')}
                ]
            ])); ?>
        </script>
        @yield('script')
        @if(env('APP_ENV') !== 'local')
            <script src="//cdn.polyfill.io/v2/polyfill.min.js"></script>
        @endif
        <script src="{{ url('/js/lang.js') }}"></script>
        <script src="{{ url(mix('js/app.js')) }}"></script>
    </body>
</html>
