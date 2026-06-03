<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<<<<<<< HEAD
// --- RUTE WEBHOOK/NOTIFIKASI MIDTRANS ---
Route::post('/midtrans/callback', [CheckoutController::class, 'callback']);
=======
Route::post('/midtrans-callback', function (Request $request) {
    $serverKey = config('midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY');
    
    // Hash untuk keamanan midtrans callback
    $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
    
    if ($hashed == $request->signature_key) {
        $order = Order::where('order_number', $request->order_id)->first();
        if ($order) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order->update(['status_payment' => 'success']);
            } else if (in_array($request->transaction_status, ['expire', 'cancel', 'deny'])) {
                $order->update(['status_payment' => 'dibatalkan', 'status_delivery' => 'dibatalkan']);
            }
        }
    }
    
    return response()->json(['message' => 'Callback received']);
});
>>>>>>> ccfc2de84719607848f913097b5b76933e471f91
