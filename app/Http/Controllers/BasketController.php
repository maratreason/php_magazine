<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        $order = Order::find($orderId);
        return view('cart.index', compact('order'));
    }

    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        return view('cart.checkout', compact('order'));
    }

    public function basketConfirmIndex()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }

        $order = Order::find($orderId);
        session()->forget('orderId');

        return view('cart.confirm', compact('order'));
    }

    public function basketConfirm(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }

        $order = Order::find($orderId);

        $success = $order->saveOrder($request->name, $request->surname, $request->email, $request->phone);

        if ($success) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Случилась ошибка');
        }

        return redirect()->route('basket-confirm-index');
    }

    public function basketAdd($id)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($id)) {
            $pivotRow = $order->products()->where('product_id', $id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($id);
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        $product = Product::find($id);
        session()->flash('success', 'Добавлен товар ' . $product->name);

        return redirect()->route('basket');
    }

    public function basketRemove($id)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return view('cart.index', compact('order'));
        }

        $order = Order::find($orderId);

        if ($order->products->contains($id)) {
            $pivotRow = $order->products()->where('product_id', $id)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($id);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        $product = Product::find($id);
        session()->flash('warning', 'Удален товар ' . $product->name);

        return redirect()->route('basket');
    }

    public function basketCheckout()
    {
        return view('cart.checkout');
    }
}
