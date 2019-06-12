@extends('EmilMoe\Base::master')

@section('site')
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

    @include('EmilMoe\Base::navbar')

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 offset-xl-1 col-md-2">
                @include('EmilMoe\Base::navigation')
            </div>
            <div class="col-xl-8 col">
                @if(isset($pagetitle))
                    <div class="row">
                        <div class="col">
                            <h2 class="col-title">
                                {{ $pagetitle }}
                            </h2>
                        </div>
                    </div>
                @endif

                @if(isset($breadcrumb) && is_array($breadcrumb))
                    <div class="row">
                        <div class="col">
                            @include('EmilMoe\Base::breadcrumb')
                        </div>
                    </div>
                @endif
                
                @yield('page')
            </div>
        </div>
    </div>

    @include('EmilMoe\Base::footer')
@endsection