@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column align-items-center justify-content-top">
        <img id="tit" src="{{asset('img/h1-piatto.png')}}" alt="title">
        {{-- @dd($plate->types) --}}
        <span>Nome Del Piatto</span>
        <h3>{{ $plate->name }}</h3>

        <span>Immagine di Copertina</span>
        <img src="{{ asset('storage/' . $plate->img) }}" alt="{{ $plate->name }}" style="width: 200px">
        {{-- <img src="{{ $plate->img }}" alt="{{ $plate->name }}" style="width: 150px"> --}}

        <span>Prezzo</span>
        <h3>{{ $plate->price }}€</h3>

        
        <span>Vegeariano</span>
        <h3>
            @if ($plate->veg)
                Sì
            @else
                No
            @endif
        </h3>
            

        <span>Stato</span>
        <h3>
            @if ($plate->availability)
                Disponibile
            @else
                Non Disponibile
            @endif
        </h3>
           
        <span>Descrizione</span>
        <p>{{ $plate->description }}</p>

        <span>Tipo</span>
        @foreach ($plate->types as $type)
            <h3>{{ $type->name}}</h3>
        @endforeach

        <div class="d-flex align-items-center mt-4 ">
            <a href="{{ route('admin.plates.index') }}" class="btn btn-go-back">Indietro</a>
            <form action="{{ route('admin.plates.destroy', $plate->id) }}" method="POST" onSubmit="return confirm('Sei sicuro di voler eliminare questo Piatto?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-enter mx-5">Cancella</button>
            <a href="{{ route('admin.plates.edit', $plate->id) }}" class="btn btn-go-back">Modifica</a>
        </form>
        
        </div>
        
    </div>

    <style scoped>
        #tit {
            margin-top: 20px;
        }
    span {
        margin-top: 40px;
        color: #703d50;
        font-style: italic;
    }

    .btn-create {
    background-color:  #ee3c4a;
    color: white;
    font-weight: bold;
    }

    .btn-go-back {
    background-color: #703d50;
    color:  white;
    font-weight: bold;
    }
    .btn-enter {
    background-color: #ee3c4a;
    color: white;
    font-weight: bold;
    }

    p {
        font-size: 18px;
    }

    body {
    background-color: whitesmoke;
    }

    </style>
@endsection