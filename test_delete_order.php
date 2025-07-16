<?php

// Test order deletion functionality
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Order;
use App\Models\OrderItem;

echo "Testing Order Deletion Functionality:\n";
echo "=====================================\n\n";

try {
  // Check current orders count
  $orderCount = Order::count();
  $orderItemsCount = OrderItem::count();

  echo "Current orders count: {$orderCount}\n";
  echo "Current order items count: {$orderItemsCount}\n\n";

  // Find a test order to try deleting
  $testOrder = Order::with('orderItems')->first();

  if ($testOrder) {
    echo "Test order found:\n";
    echo "- ID: {$testOrder->id}\n";
    echo "- Order Number: {$testOrder->order_number}\n";
    echo "- Customer: {$testOrder->customer_name}\n";
    echo "- Order Items Count: " . $testOrder->orderItems->count() . "\n\n";

    // Backup order data
    $orderId = $testOrder->id;
    $orderNumber = $testOrder->order_number;
    $itemsCount = $testOrder->orderItems->count();

    echo "Attempting to delete order...\n";

    // Try to delete the order
    $deleted = $testOrder->delete();

    if ($deleted) {
      echo "✓ Order deleted successfully!\n";

      // Check if order items were also deleted
      $remainingItems = OrderItem::where('order_id', $orderId)->count();
      echo "✓ Remaining order items for deleted order: {$remainingItems}\n";

      // Check new counts
      $newOrderCount = Order::count();
      $newItemsCount = OrderItem::count();

      echo "✓ New orders count: {$newOrderCount} (was {$orderCount})\n";
      echo "✓ New order items count: {$newItemsCount} (was {$orderItemsCount})\n";
    } else {
      echo "✗ Failed to delete order\n";
    }
  } else {
    echo "No orders found to test deletion\n";
  }
} catch (Exception $e) {
  echo "✗ Error: " . $e->getMessage() . "\n";
  echo "File: " . $e->getFile() . "\n";
  echo "Line: " . $e->getLine() . "\n";
  echo "Trace: " . $e->getTraceAsString() . "\n";
}
