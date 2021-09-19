@extends('layouts.app')

@section('content')
        <div class="col-10 offset-1">
                <div class="my-5 text-center">
                        <img src="{{asset('img/ordini.png')}}" alt="title">
                </div>
                <table class="table table-striped">
                        <thead>
                                <tr>
                                        <th>Consegna a:</th>
                                        <th>Recapito:</th>
                                        <th>Indirizzo:</th>
                                        <th>Data:</th>
                                        <th>Riepilogo:</th>
                                        <th>Totale:</th>
                                </tr>
                        </thead>
                        <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                        <td>{{ $order->name }} {{ $order->lastname }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->riepilogo }}</td>
                                        <td>{{ $order->price }}€</td>
                                </tr>
                                @endforeach
                        </tbody>
                </table>
                <a href="{{ route('admin.restaurants.index') }}" class="btn btn_color my-3">Torna al Ristorante</a>
        </div>
@endsection