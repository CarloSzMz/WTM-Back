<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Order_Article;
use App\Models\Stock;
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
            'status' => 1
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

            $stock = Stock::where('articles.id', $producto['article_id'])
                ->leftjoin('articles', 'articles.stock_id', '=', 'stock.id')
                ->select(
                    'stock.*'
                )
                ->first();
            $resta = $stock->quantity - $producto['quantity'];
            $stock->update([
                'quantity' => $resta
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
        $order = Order::where('orders.id', $id)
            ->join('users', 'users.id', '=', 'user_id')
            ->select(
                'orders.*',
                'users.*',
                'orders.id as OrderId'
            )
            ->first();  //Pedido
        //dd($order);
        $orderArticles = Order_Article::where('order_id', $id)
            ->join('articles', 'articles.id', '=', 'article_id')
            ->leftjoin('stock', 'stock.id', '=', 'articles.stock_id')
            ->select(
                'orders_articles.*',
                'articles.*',
                'stock.price'
            )
            ->get();  //Articulos del pedido
        //dd($orderArticles);

        return view('order.show', compact('order', 'orderArticles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //no se puede editar el pedido
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //no se puede editar el pedido
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
