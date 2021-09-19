@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @dd($newRestaurant->user->name) --}}
    {{-- @if (!$newRestaurant->isEmpty())
        @foreach ($newRestaurant as $item)
            <p>{{ $item->name }}</p>
        @endforeach
    @else
        <p>Nesun Ristorante associato</p>
    @endif --}}
    @if ($newRestaurant)
        {{-- <h2 class="title green mt-5">Il tuo Ristorante</h2> --}}
        <div class="my-5 text-center">
            <img src="{{asset('img/il-tuo-ristorante.png')}}" alt="title" >
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <img src="{{ asset('storage/' . $newRestaurant->cover) }}" alt="{{ $newRestaurant->name }}" class="rest-img">
                </div>
                <div class="col-lg-4 d-flex flex-column justify-content-around align-items-center">
                    <h5><strong>Propietario:</strong> {{ $newRestaurant->user->name }}</h5>
                    <h5><strong>Partita Iva:</strong> {{ $newRestaurant->piva }}</h5>
                    <br>
                    <h5><strong>Città:</strong> Roma</h5>
                    <h5><strong>Via:</strong> {{ $newRestaurant->address }}</h5>
                    <h5><strong>Partita Iva:</strong> {{ $newRestaurant->piva }}</h5>
                    <h5><strong>Nome Ristorante:</strong> {{ $newRestaurant->name }}</h5>

                    <p class="category mt-3 mb-0 text-center">
                        <strong>CATEGORIE:</strong><br>
                        @foreach ($newRestaurant->categories as $item)
                            <span class="btn-secondary btn-sm">{{ $item->name }}</span>   
                        @endforeach
                    </p>
                </div>

                <div class="col-lg-4 d-flex flex-column justify-content-around align-items-center">
                    <a href="{{ route('admin.restaurants.edit', $newRestaurant->id) }}" class="btn bg">Modifica Locale</a>
                    <a href="{{ route('admin.plates.index') }}" class="btn bg">Visualizza il Menù</a>
                    <a href="{{ route('admin.orders.index') }}" class="btn bg">I tuoi Ordini</a>
                    <form action="{{ route('admin.restaurants.destroy', $newRestaurant->id) }}" method="POST" onSubmit="return confirm('Sei sicuro di voler eliminare questo Ristorante?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg">DELETE</button>
                    </form>
                </div>
            </div>
        </div>

        
        
    @else
        <h4>Non ci sono ristoranti</h4>

        <a href="{{ route('admin.restaurants.create') }}" class="btn btn_color">Crea Il Tuo Ristorante</a>

    @endif
</div>    

<style>

    .rest-img {
        width: 100%;
    }
    .title {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .bg {
        background-image: linear-gradient(90deg, #ee3c4a, #fc8237);
        color: white;
    }

    form {
        display: inline-block;
    }

    .wrapper_link > a {
        margin: 0 10px;        
    }

    h4 {
        margin: 15px 0
    }
</style>
    
@endsection