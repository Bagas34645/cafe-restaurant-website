<?php

// Test delete route functionality
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Order;

echo "Testing Delete Route Functionality:\n";
echo "===================================\n\n";

try {
  // Get route info
  $route = app('router')->getRoutes()->getByName('admin.orders.destroy');

  if ($route) {
    echo "✓ Route 'admin.orders.destroy' exists\n";
    echo "URI: " . $route->uri() . "\n";
    echo "Methods: " . implode(', ', $route->methods()) . "\n";
    echo "Controller: " . $route->getActionName() . "\n\n";
  } else {
    echo "✗ Route 'admin.orders.destroy' not found\n";
  }

  // Check if we have orders to test with
  $orderCount = Order::count();
  echo "Current orders in database: {$orderCount}\n";

  if ($orderCount > 0) {
    $testOrder = Order::first();
    echo "Test order available: #{$testOrder->id} - {$testOrder->order_number}\n";

    // Generate the delete URL
    $deleteUrl = route('admin.orders.destroy', $testOrder->id);
    echo "Delete URL would be: {$deleteUrl}\n";
  }
} catch (Exception $e) {
  echo "✗ Error: " . $e->getMessage() . "\n";
}
