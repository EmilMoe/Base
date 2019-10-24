@extends('EmilMoe\Base::master')

@section('site')
    <div id="app">
        <div class="page-container">
            @include('EmilMoe\Base::snippets.navbar')

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-2 offset-xl-1 col-md-2">
                        @include('EmilMoe\Base::snippets.navigation')
                    </div>
                    <div class="col-xl-8 col-md-10">
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
                                    @include('EmilMoe\Base::snippets.breadcrumb')
                                </div>
                            </div>
                        @endif

                        <div id="loader-container">
                            @yield('page')
                        </div>
                    </div>
                </div>
            </div>

            @include('EmilMoe\Base::snippets.footer')
        </div>
    </div>
@endsection
