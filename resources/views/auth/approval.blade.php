@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>{{ __('Waiting for Admin approval') }}</small>
                        </div>
                        <div>
                            
                            {{ __('Your email is verified. Your account is under verification, you will receive email once approved') }}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
