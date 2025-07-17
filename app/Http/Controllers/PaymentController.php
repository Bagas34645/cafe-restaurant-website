<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.is_production');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function midtrans($orderId)
    {
        $order = Order::with('orderItems')->findOrFail($orderId);

        if ($order->status !== 'pending') {
            return redirect()->route('checkout.success', $order->order_number)
                ->with('info', 'Pesanan ini sudah diproses sebelumnya');
        }

        // Required
        $transaction_details = array(
            'order_id' => $order->order_number,
            'gross_amount' => $order->total_amount, // no decimal allowed for creditcard
        );

        // Optional
        $item_details = array();
        foreach ($order->orderItems as $item) {
            $item_details[] = array(
                'id' => $item->product_id,
                'price' => $item->product_price,
                'quantity' => $item->quantity,
                'name' => $item->product_name
            );
        }

        // Optional
        $customer_details = array(
            'first_name'    => $order->customer_name,
            'email'         => $order->customer_email,
            'phone'         => $order->customer_phone,
            'billing_address'  => array(
                'first_name'       => $order->customer_name,
                'email'            => $order->customer_email,
                'phone'            => $order->customer_phone,
                'address'          => $order->customer_address,
            ),
            'shipping_address' => array(
                'first_name'       => $order->customer_name,
                'email'            => $order->customer_email,
                'phone'            => $order->customer_phone,
                'address'          => $order->customer_address,
            )
        );

        // Data yang akan dikirim untuk request redirect_url.
        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            // Set callbacks for redirect handling
            'callbacks' => [
                'finish' => route('payment.success'),
                'error' => route('payment.failed'),
            ],
            // Custom expiry (optional)
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s O'),
                'unit' => 'minutes',
                'duration' => 60
            ]
        );

        $snapToken = Snap::getSnapToken($transaction);

        return view('payment.midtrans', compact('order', 'snapToken'));
    }

    public function notification(Request $request)
    {
        $notification = new Notification();

        $order = Order::where('order_number', $notification->order_id)->first();

        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $order_id = $notification->order_id;
        $fraud = $notification->fraud_status;

        // Update order status based on notification
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $order->update([
                        'status' => 'pending',
                        'midtrans_status' => 'challenge',
                        'midtrans_transaction_id' => $notification->transaction_id
                    ]);
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $order->update([
                        'status' => 'paid',
                        'midtrans_status' => 'capture',
                        'midtrans_transaction_id' => $notification->transaction_id,
                        'paid_at' => now()
                    ]);
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $order->update([
                'status' => 'paid',
                'midtrans_status' => 'settlement',
                'midtrans_transaction_id' => $notification->transaction_id,
                'paid_at' => now()
            ]);
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $order->update([
                'status' => 'pending',
                'midtrans_status' => 'pending',
                'midtrans_transaction_id' => $notification->transaction_id
            ]);
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $order->update([
                'status' => 'cancelled',
                'midtrans_status' => 'deny',
                'midtrans_transaction_id' => $notification->transaction_id
            ]);
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $order->update([
                'status' => 'cancelled',
                'midtrans_status' => 'expire',
                'midtrans_transaction_id' => $notification->transaction_id
            ]);
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $order->update([
                'status' => 'cancelled',
                'midtrans_status' => 'cancel',
                'midtrans_transaction_id' => $notification->transaction_id
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    public function finish(Request $request)
    {
        $order_id = $request->order_id;
        $order = Order::where('order_number', $order_id)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan');
        }

        return redirect()->route('checkout.success', $order->order_number);
    }

    public function unfinish(Request $request)
    {
        $order_id = $request->order_id;
        $order = Order::where('order_number', $order_id)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan');
        }

        return redirect()->route('checkout.index')->with('warning', 'Pembayaran belum selesai. Silakan coba lagi.');
    }

    public function error(Request $request)
    {
        return redirect()->route('checkout.index')->with('error', 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
    }

    public function success(Request $request)
    {
        $orderNumber = $request->get('order_id');
        $order = Order::where('order_number', $orderNumber)->first();

        if ($order) {
            // Check payment status from Midtrans
            try {
                $status = Transaction::status($orderNumber);
                $statusObj = (object) $status;

                if (
                    isset($statusObj->transaction_status) &&
                    ($statusObj->transaction_status == 'settlement' ||
                        $statusObj->transaction_status == 'capture')
                ) {
                    $order->update([
                        'status' => 'paid',
                        'midtrans_status' => $statusObj->transaction_status,
                        'midtrans_transaction_id' => $statusObj->transaction_id ?? null,
                        'paid_at' => now()
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Error checking payment status: ' . $e->getMessage());
            }
        }

        return view('payment.success', compact('order'));
    }

    public function failed(Request $request)
    {
        $orderNumber = $request->get('order_id');
        $order = Order::where('order_number', $orderNumber)->first();

        return view('payment.failed', compact('order'));
    }
}
