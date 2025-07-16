<?php

// Test admin orders functionality
require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use App\Models\Order;

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Admin Orders Functionality:\n";
echo "===================================\n\n";

try {
  // Test basic order query
  $orders = Order::with('orderItems.product')->orderBy('created_at', 'desc')->paginate(20);
  echo "✓ Orders query successful\n";
  echo "Total orders: " . $orders->total() . "\n\n";

  // Display sample order data
  foreach ($orders->take(3) as $order) {
    echo "Order: {$order->order_number}\n";
    echo "Customer: {$order->customer_name}\n";
    echo "Total: Rp " . number_format($order->total_amount, 0, ',', '.') . "\n";
    echo "Status: {$order->status}\n";
    echo "Payment: {$order->payment_method}\n";
    echo "Items count: " . $order->orderItems->count() . "\n";
    echo "Date: " . $order->created_at->format('d/m/Y H:i') . "\n";
    echo "---\n";
  }
} catch (Exception $e) {
  echo "✗ Error: " . $e->getMessage() . "\n";
  echo "File: " . $e->getFile() . "\n";
  echo "Line: " . $e->getLine() . "\n";
}
