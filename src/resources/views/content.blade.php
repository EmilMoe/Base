@extends('EmilMoe\Base::master')

@section('page')
    <section class="section-xl">
        @if(isset($pagename))
            <h1>
                {{ $pagename }}
            </h1>
        @endif

        @yield('content')
    </section>
@endsection