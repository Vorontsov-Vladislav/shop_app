<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('product')->latest()->get();
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('order.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => ['required', 'regex:/^[А-Яа-яЁё\s]+$/u', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ], [
            'quantity.max' => 'Слишком большое количество. Итоговая сумма заказа не должна превышать 99 999 999.99 руб.',
        ]);

        $product = Product::findOrFail($request->product_id);
        $maxTotalPrice = 99999999.99;

        $totalPrice = $product->price * $request->quantity;

        if ($totalPrice > $maxTotalPrice) {
            return redirect()->back()
                ->withErrors(['quantity' => 'Сумма заказа превышает допустимый лимит (99 999 999.99 руб.).'])
                ->withInput();
        }

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => 'новый',
            'comment' => $request->comment ?? null,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('order.index')->with('success', 'Заказ успешно создан!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('product')->findOrFail($id);
        return view('order.show', compact('order'));
    }

    /**
     * Change order status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'выполнен']);

        return redirect()->route('order.index')->with('success', 'Заказ отмечен как выполненный!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->route('order.index')->with('success', 'Заказ удалён!');
    }
}