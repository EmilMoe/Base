@extends('EmilMoe\Base::master-admin')

@section('page')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Rediger menu
                    </h5>
                    <h6 class="card-subtitle">
                        Træk og slip for at definere rækkefølgen af menupunkterne.
                    </h6>
                    <ul class="list-group">
                        @foreach($menu as $nav)
                            <li class="list-group-item">
                                {!! $nav->icon !!}
                                {{ $nav->text }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection