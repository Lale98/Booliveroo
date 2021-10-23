@extends('layouts.app')

@section('content')
    <body>
        
        <div class="col-8 offset-2">
            <div class="mb-5 text-center ">
                <img id="tit" src="{{asset('img/le-tue-info.png')}}" alt="title">
            </div>
            <form action="{{ route('orders.store') }}"  method="POST" id="form1" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name" class="font-weight-bold text-uppercase">
                      Nome
                    </label>
                  <input type="text" class="form-control" id="name" placeholder="Inserisci il tuo nome" name="name">
                </div>
                @error('name')
                      <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="form-group">
                    <label for="lastname" class="font-weight-bold text-uppercase">
                        Cognome
                    </label>
                    <input type="text" class="form-control" id="lastname" placeholder="Inserisci il tuo cognome" name="lastname">
                  </div>
                @error('lastname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="form-group">
                    <label for="address" class="font-weight-bold text-uppercase">
                        Indirizzo
                    </label>
                    <input type="text" class="form-control" id="address" placeholder="Inserisci il tuo indirizzo di consegna" name="address">
                  </div>
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    <label for="phone" class="font-weight-bold text-uppercase">
                        Numero di telefono
                    </label>
                    <input type="text" class="form-control" id="phone" placeholder="Inserisci il tuo numero di telefono" name="phone">
                  </div>
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    <label for="email" class="font-weight-bold text-uppercase">
                        Mail
                    </label>
                    <input type="email" class="form-control" id="email" placeholder="Inserisci la tua mail" name="email">
                  </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group d-none">
                    <label for="restaurant_id"></label>
                    <input type="hidden" class="form-control" id="restaurant_id" placeholder="Inserisci la tua mail" name="restaurant_id" value="">
                </div>

                <div class="form-group d-none">
                    <label for="price"></label>
                    <input type="hidden" class="form-control" id="price" name="price" value="">
                </div>

                <div class="form-group d-none">
                    <label for="riepilogo"></label>
                    <input type="hidden" class="form-control" id="riepilogo" name="riepilogo" value="">
                </div>
                <button type="submit" class="btn btn_color">
                    Vai al Pagamento
                </button>
            </form>
        </div>

        <style scoped>
            #tit {
                margin-top: 20px;
            }
            label {
                color: #EE3C4A;
            }
        </style>

        <script>
            var restaurantId = JSON.parse(localStorage.getItem('restaurantID'));
            var price = JSON.parse(localStorage.getItem('totalPrice'));
            var carts = JSON.parse(localStorage.getItem('carts'));

            var piatto = '';
            for(let i=0; i<carts.length; i++){
                piatto += carts[i].name + ' ->' + carts[i].quantity + '; ';
            }

            window.addEventListener('DOMContentLoaded', (event) => {
                document.querySelector('#restaurant_id').value = restaurantId;
                document.querySelector('#price').value = price;
                document.querySelector('#riepilogo').value = piatto;
                console.log(piatto);
            });

            function datiCliente(){
                //console.log(JSON.parse(localStorage.getItem('restaurantID')));
                let restaurantID = JSON.stringify(this.restaurantID);
                localStorage.setItem('restaurantID', restaurantID);
            }


        </script>
    </body>
@endsection