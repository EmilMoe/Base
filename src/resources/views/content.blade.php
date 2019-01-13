@extends('EmilMoe\Base::master')

@section('page')
    <section class="section-xl">
        @if(isset($pagename))
            <h1>
                {{ $pagename }}
            </h1>
        @endif

        @if(isset($hasContent) && ! $hasContent)
            <div align="center">
                <h3>
                    {{ __('EmilMoe\Base::content.empty.title', [
                        'type' => $content['type']
                    ]) }}
                </h3>
                <p>
                    {{ __('EmilMoe\Base::content.empty.message') }}
                </p>
            </div>
        @else
            @yield('content')
        @endif
    </section>
@endsection