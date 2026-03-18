<?php

namespace Bystrov\AbstractShop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Bystrov\AbstractShop\Models\Order;
use Bystrov\AbstractShop\Models\Customer;
use Bystrov\AbstractShop\Models\Product;
use Bystrov\AbstractShop\Services\DeliveryCostService;

class OrderController extends Controller
{
    public function index()
    {
        return view('abstract-shop::orders.index', [
            'items' => Order::query()->orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('abstract-shop::orders.create', [
            'customers' => Customer::query()->orderBy('name')->get(),
            'products' => Product::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request, DeliveryCostService $delivery)
    {
        $data = $request->validate([
            'customer_id' => ['nullable', 'integer'],
            'currency' => ['required', 'string', 'size:3'],
            'from_address' => ['nullable', 'string', 'max:255'],
            'to_address' => ['nullable', 'string', 'max:255'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
        ]);

        return DB::transaction(function () use ($data, $delivery) {
            $order = Order::query()->create([
                'customer_id' => $data['customer_id'] ?? null,
                'status' => 'NEW',
                'currency' => strtoupper($data['currency']),
                'total' => 0,
                'from_address' => $data['from_address'] ?? null,
                'to_address' => $data['to_address'] ?? null,
            ]);

            $total = 0.0;
            foreach ($data['items'] as $row) {
                $p = Product::query()->findOrFail($row['product_id']);
                $qty = (int) $row['qty'];
                $line = (float) $p->price * $qty;
                $total += $line;

                DB::table('abstract_shop_order_items')->insert([
                    'order_id' => $order->id,
                    'product_id' => $p->id,
                    'product_name' => $p->name,
                    'price' => $p->price,
                    'qty' => $qty,
                    'line_total' => $line,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            if (!empty($order->from_address) && !empty($order->to_address)) {
                $est = $delivery->estimate($order->from_address, $order->to_address);
                $order->delivery_distance_km = $est['distance_km'];
                $order->delivery_price = $est['price'];
                $total += (float) $est['price'];
            }

            $order->total = $total;
            $order->save();

            return redirect()->route('abstract-shop.orders.show', $order);
        });
    }

    public function show(Order $order)
    {
        $items = DB::table('abstract_shop_order_items')->where('order_id', $order->id)->get();
        return view('abstract-shop::orders.show', ['item' => $order, 'items' => $items]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('abstract-shop.orders.index');
    }
}

