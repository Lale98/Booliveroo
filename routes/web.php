<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('guest.home');
});


Route::get('/payment', function () {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $token = $gateway->ClientToken()->generate();

    return view('payment', ['token' => $token]);
});


Route::post('/checkout', function(Request $request){
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);
    
    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        $transaction = $result->transaction;
        //header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
        return back()->with('success_message', 'Transaction successful. The ID is:' . $transaction->id);
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        /* $_SESSION["errors"] = $errorString;
        header("Location: " . $baseUrl . "index.php"); */
        return back()->withErrors('Errore' . $result->message);
    }
});



//rotte di autenticazione
Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function() {

    Route::get('/', 'HomeController@showRestaurant')->name('index');    
    Route::resource('restaurants', 'RestaurantController');
    Route::resource('plates', 'PlateController');
    Route::resource('orders', 'OrderController');    
    // Route::get('pay', 'HomeController@pay')->name('pay');
});



Route::resource('orders', 'OrderController');

Route::get('/form-cliente', function () {
    return view('form-cliente');
});

Route::get('/Successo', function () {
    return view('Successo');
});


//rotte pubbliche
Route::get('{any?}', 'HomeController@index')->where('any', '.*')->name('home');
