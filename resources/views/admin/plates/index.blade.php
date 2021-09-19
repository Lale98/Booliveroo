@extends('layouts.app')

@section('content')
<div class="container ">
    <div class=" d-flex flex-column align-items-center justify-content-center">
        <img id="tit" src="{{asset('img/h1-menu.png')}}" alt="title">
        <a href="{{ route('admin.plates.create') }}" class="btn btn-create my-3">Crea Piatto</a>
        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-go-back">Torna al Ristorante</a>
    </div>

    <div class="my-3 d-flex justify-content-around align-items-center flex-wrap">
        @foreach ($plates as $plate)
            <div class="cards text-center">
                <h5 class="p-4">{{ $plate->name }}</h5>
                <img src="{{ asset('storage/' . $plate->img) }}" alt="{{ $plate->name }}" style="width: 100px">
                <h6>{{ $plate->price }}€</h6>
                <a href="{{ route('admin.plates.show', $plate->id) }}" class="btn btn-create">Visualizza</a>
            </div>
        @endforeach
    </div>
</div>  

<style lang="scss" scoped>
    #tit {
        margin-top: 20px
    }
    h1 {
        margin: 30px;
    }
    .btn-create {
        background-color:  #ee3c4a;
        color: white;
        font-weight: bold;
    }

    .btn-go-back {
        background-color: #703d50;
        color:  #fc8237;
        font-weight: bold;
    }
    .btn-enter {
        background-color: #ee3c4a;
        color: white;
        font-weight: bold;
    }

    .cards {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        width: 25%;
        min-width: 230px;
        height: 330px;
        margin: 80px 30px;
        background-color: whitesmoke;
        border: 2px solid #703d50;
        border-radius: 10px;
    }

    body {
        /* background-image: linear-gradient(90deg, #ee3c4a, #fc8237); */
        background-image: white;
    }

</style>
    
@endsection