<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$order = App\Models\Order::where('order_number', 'LW-1780498618-4707')->first();
if (!$order) {
    die("Order not found");
}

\Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
\Midtrans\Config::$isProduction = false;

try {
    $status = \Midtrans\Transaction::status($order->order_number);
    print_r($status);
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
