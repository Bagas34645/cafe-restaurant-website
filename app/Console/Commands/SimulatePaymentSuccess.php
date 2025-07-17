<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class SimulatePaymentSuccess extends Command
{
  protected $signature = 'payment:simulate-success {order_number?}';
  protected $description = 'Simulate successful payment for testing purposes';

  public function handle()
  {
    $orderNumber = $this->argument('order_number');

    if ($orderNumber) {
      $order = Order::where('order_number', $orderNumber)->first();
      if (!$order) {
        $this->error("Order {$orderNumber} not found!");
        return;
      }
      $orders = collect([$order]);
    } else {
      // Get all pending orders
      $orders = Order::where('status', 'pending')->get();
    }

    if ($orders->isEmpty()) {
      $this->info('No pending orders found.');
      return;
    }

    $this->info('Found ' . $orders->count() . ' pending order(s):');

    foreach ($orders as $order) {
      $this->line("- {$order->order_number} ({$order->customer_name})");
    }

    if ($this->confirm('Do you want to mark these orders as PAID?')) {
      foreach ($orders as $order) {
        $order->update([
          'status' => 'paid',
          'midtrans_status' => 'settlement',
          'midtrans_transaction_id' => 'TEST_' . time() . '_' . $order->id,
          'paid_at' => now()
        ]);

        $this->info("✓ Order {$order->order_number} marked as PAID");
      }

      $this->info('All orders updated successfully!');
    } else {
      $this->info('Operation cancelled.');
    }
  }
}
