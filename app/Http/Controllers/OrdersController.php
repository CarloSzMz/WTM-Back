<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\Order_Article;
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

        // dd($basket, $total_price, $user);

        $orders = Order::get();

        return view('order.create', compact('basket', 'orders', 'user', 'total_price'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //dd($request);

        $request->validate([
            'user_id' => 'required',
        ]);

        Order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
        ]);

        $pedido = Order::where('user_id', $request->user_id)->latest()->first();

        //dd($pedido);

        $productos_raw = $request->basket;
        //dd($orders_articles);
        $productos = json_decode($productos_raw, true);


        foreach ($productos as $producto) {
            Order_Article::create([
                'order_id' => $pedido->id,
                'article_id' => $producto['article_id'],
                'quantity' => $producto['quantity'],
            ]);
        }


        Basket::where('user_id', $request->user_id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'Pedido creado con éxito.');
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
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')
            ->with('success', 'order eliminado');
    }
}
