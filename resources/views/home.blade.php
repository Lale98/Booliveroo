@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __("Hai eseguito l'accesso!") }}
                </div>

            </div>

            <div class="text-center my-3 btn bg">
                <a href="{{ route('admin.index') }}">Il tuo Ristorante</a>
            </div>
                
        </div>
    </div>
</div>

<style>
    .bg {
        background-image: linear-gradient(90deg, #ee3c4a, #fc8237);
        
    }

    a {
        color: white;
    }

    a:hover {
        color: white;
    }
</style>
@endsection
