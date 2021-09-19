@extends('layouts.app')

@section('content')
    <body>
        <div class="mb-5 text-center ">
            <img id="tit" src="{{asset('img/pagamento.png')}}" alt="title">
        </div>
        <div class="col-8 offset-2">
            <form onsubmit="return false" action="{{ url('/checkout') }}"  method="POST" id="form2" class="text-center">
                @csrf
                <section class="d-flex flex-column justify-content-center align-items-center">
                    <label for="amount" class="text-center">
                        <h5 class="input-label text-uppercase">Totale</h5>
                        <div class="input-wrapper amount-wrapper">
                            <input class="total text-center font-weight-bold " id="amount" name="amount" type="tel" value="" readonly>
                        </div>
                    </label>
                    <div class="bt-drop-in-wrapper width">
                        <div id="bt-dropin"></div>
                    </div>
                </section>
                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="btn btn_color" type="submit">
                    Paga
                </button>
            </form>
        </div>

        <style>
            #tit {
                margin-top: 20px;
            }
            .total {
                border: none;
                font-size: 26px;
            }
        </style>
        
        <script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
        <script>

            var form = document.querySelector('#form2');
            var client_token = "{{ $token }}";
            
            window.addEventListener('DOMContentLoaded', (event) => {
                var totale = JSON.parse(localStorage.getItem('totalPrice'));
                document.querySelector('#amount').value = totale.toFixed(2);
            });
            

            braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            }, function (createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }

                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();

                setInterval(function(){window.location.href = "http://127.0.0.1:8000/Successo";}, 1000);
                });
                
            });
            });
        </script>
    </body>
@endsection