<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('orderItems.product')->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method !== '') {
            $query->where('payment_method', $request->payment_method);
        }

        // Search by order number or customer name
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'LIKE', "%{$search}%")
                    ->orWhere('customer_name', 'LIKE', "%{$search}%")
                    ->orWhere('customer_email', 'LIKE', "%{$search}%");
            });
        }

        $orders = $query->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);

            // Log the deletion attempt
            \Log::info("Attempting to delete order: {$order->order_number} (ID: {$id})");

            $order->delete();

            \Log::info("Order {$order->order_number} deleted successfully");

            return back()->with('success', 'Pesanan berhasil dihapus');
        } catch (\Exception $e) {
            \Log::error("Failed to delete order ID {$id}: " . $e->getMessage());

            return back()->with('error', 'Gagal menghapus pesanan: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $query = Order::with('orderItems.product')->orderBy('created_at', 'desc');

        // Apply same filters as index
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('payment_method') && $request->payment_method !== '') {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'LIKE', "%{$search}%")
                    ->orWhere('customer_name', 'LIKE', "%{$search}%")
                    ->orWhere('customer_email', 'LIKE', "%{$search}%");
            });
        }

        $orders = $query->get();

        $csv = "Order Number,Customer Name,Customer Email,Customer Phone,Total Amount,Payment Method,Status,Order Date\n";

        foreach ($orders as $order) {
            $csv .= "{$order->order_number},{$order->customer_name},{$order->customer_email},{$order->customer_phone},{$order->total_amount},{$order->payment_method},{$order->status},{$order->created_at->format('Y-m-d H:i:s')}\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="orders_export_' . date('Y-m-d') . '.csv"');
    }

    public function confirmPayment(Order $order)
    {
        try {
            if ($order->status === 'paid') {
                return back()->with('info', 'Pesanan sudah dikonfirmasi pembayarannya sebelumnya');
            }

            $order->update([
                'status' => 'paid',
                'midtrans_status' => 'manual_confirmation',
                'midtrans_transaction_id' => 'MANUAL_' . time() . '_' . $order->id,
                'paid_at' => now()
            ]);

            \Log::info("Payment manually confirmed for order: {$order->order_number}");

            return back()->with('success', 'Pembayaran pesanan berhasil dikonfirmasi');
        } catch (\Exception $e) {
            \Log::error("Failed to confirm payment for order {$order->id}: " . $e->getMessage());
            return back()->with('error', 'Gagal mengkonfirmasi pembayaran: ' . $e->getMessage());
        }
    }
}
