<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock = Stock::get();
        return view('stock.index', compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stock = Stock::get();

        return view('stock.create', compact('stock'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $price = str_replace(',', '.', $request->price);


        Stock::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $price,
        ]);

        return redirect()->route('stock.index')
            ->with('success', 'Stock creado con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $stock = Stock::select(
            'stock.name as StockName',
            'stock.id as StockId',
            'stock.*'
        )->findOrFail($id);

        return view('stock.edit', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $request->validate([
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $stock = Stock::findOrFail($id);
        //dd($usuario);
        $stock->update([
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return redirect()->route('stock.index')
            ->with('success', 'Stock actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stock.index')
            ->with('success', 'Stock eliminado');
    }
}
