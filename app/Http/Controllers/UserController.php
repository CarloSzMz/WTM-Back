<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();

        return view('users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => ['required', 'min:8'],
            'pais' => 'required',
            'provincia' => 'required',
            'calle' => 'required',
            'tipo' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'pais' => $request->pais,
            'provincia' => $request->provincia,
            'calle' => $request->calle,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->first();

        $basket = Basket::where('basket.user_id', $id)
            ->join('articles', 'articles.id', '=', 'basket.article_id')
            ->select(
                'basket.*',
                'articles.name as NombreArticulo'
            )
            ->get();


        $orders = Order::where('orders.user_id', $id)
            ->select(
                'orders.*',
            )
            ->get();


        // el pedido es todo lo q haya en basket, cuando se crea uno se vacia la cesta por lo q hay q ver basket.* que coincida con el user
        // como haria para la cantidad? en caso de que el pedido se cancele?  se podrá editar el pedido? solo contiene articulos 
        // crear tabla intermedia entre pedido y articulo para tener varios articulos en el mismo pedido

        // dd($basket);
        //dd($orders);

        return view('users.show', compact('user', 'basket','orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::select(
            'users.name as UserName',
            'users.id as UserId',
            'users.*'
        )->findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::findOrFail($id);
        //dd($usuario);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'pais' => $request->pais,
            'provincia' => $request->provincia,
            'calle' => $request->calle,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado');
    }
}
