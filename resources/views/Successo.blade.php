@extends('layouts.app')

@section('content')
    <div class="full-screen">
        <div class="success">
            <h1 class="text-uppercase">
                Pagamento avvenuto con successo!
            </h1>
            <h4>
                Il tuo ordine è stato inviato al ristorante
            </h4>
        </div>
        <a href="http://127.0.0.1:8000/" class="btn btn_color mt-5">
            Torna alla Home
        </a>
    </div>

    <style>
        .full-screen {
            height: calc(100vh - 77px);
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .success {
            width: 500px;
            height: 300px;
            border: 3px solid #EE3C4A;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-image: url('img/jumbotron-gradientred.jpg');
            background-size: cover;
        }

        h1 {
            color: #f5f5f5;
        }
    </style>
@endsection