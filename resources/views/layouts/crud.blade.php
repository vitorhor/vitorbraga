@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header d-flex justify-content-lg-between">
                        @yield("crud_card_header")
                    </div>

                    <div class="card-body">
                        @yield('crud_card_content')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
