<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Basket;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $basket = Basket::get();
        return view('basket.index', compact('basket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userid)
    {

        $user = User::where('users.id', $userid)->first();

        $basket = Basket::get();

        $articles = Article::leftjoin('stock', 'stock.id', '=', 'articles.stock_id')
            ->select(
                'articles.*',
                'stock.price as Precio'
            )->get();

        //dd($articles);

        return view('basket.create', compact('basket', 'articles', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request);
        $request->validate([
            'article_id' => 'required',
            'quantity' => 'required',
        ]);

        $price = Article::where('articles.id', $request->article_id)
            ->leftjoin('stock', 'stock.id', '=', 'articles.stock_id')
            ->select(
                'stock.price as Precio'
            )->first();


        // Convertir el precio y la cantidad a enteros
        $price = (int)$price->Precio;
        $quantity = (int)$request->quantity;

        // Calcular el precio total
        $total_price = $price * $quantity;

        //dd($total_price);


        Basket::create([
            'article_id' => $request->article_id,
            'quantity' => $request->quantity,
            'total' => $total_price,
            'user_id' => $request->user_id,
        ]);

        $userid = $request->user_id;

        return redirect()->route('users.show', ['user' => $userid])
            ->with('success', 'Articulo creado con éxito.');
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
        $basket = Basket::join('articles', 'articles.id', '=', 'basket.article_id')
            ->select(
                'articles.name as NombreArticulo',
                'basket.*'
            )->findOrFail($id);

        return view('basket.edit', compact('basket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //dd($request);
        $request->validate([
            'quantity' => 'required',
        ]);

        $basket = Basket::findOrFail($id);
        //dd($usuario);

        $price = Article::where('articles.id', $request->article_id)
            ->leftjoin('stock', 'stock.id', '=', 'articles.stock_id')
            ->select(
                'stock.price as Precio'
            )->first();


        // Convertir el precio y la cantidad a enteros
        $price = (int)$price->Precio;
        $quantity = (int)$request->quantity;

        // Calcular el precio total
        $total_price = $price * $quantity;

        $basket->update([
            'quantity' => $request->quantity,
            'total' => $total_price,
        ]);

        $userid = $request->user_id;

        return redirect()->route('users.show', ['user' => $userid])
            ->with('success', 'Articulo creado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $userid)
    {
        $basket = Basket::findOrFail($id);
        $basket->delete();

        return redirect()->route('users.show', ['user' => $userid])
            ->with('success', 'Usuario eliminado');
    }
}
