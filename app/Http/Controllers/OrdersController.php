<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->select(
                'users.name as NombreUsuario',
                'orders.*',
            )->get();
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userid)
    {
        //
        $basket = Basket::where('user_id', $userid)
            ->join('articles', 'articles.id', '=', 'basket.article_id')
            ->select(
                'articles.name as NombreArticulo',
                'articles.url_img as ImagenProducto',
                'articles.discount as Descuento',
                'basket.*'
            )
            ->get();

        $total_price = 0;

        foreach ($basket as $item) {
            $total_price += $item->total;
        }

        $user = User::where('id', $userid)->first();

        dd($basket, $total_price, $user);

        $orders = Order::get();

        return view('order.create', compact('basket', 'orders', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        //necesita referencias a las tablas a las que se refiere
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')
            ->with('success', 'order eliminado');
    }
}
