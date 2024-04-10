<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Basket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    //DEVUELVE TODOS LOS USUARIOS (GET)
    public function users()
    {
        $users = User::get();

        return response()->json([
            "data" => $users,
        ]);
    }

    //DEVUELVE TODOS LOS PRODUCTOS (GET)
    public function productos()
    {
        $productos = Article::get();

        return response()->json([
            "data" => $productos
        ]);
    }

    //REGISTRA USUARIO (POST)
    public function register(Request $request)
    {

        $request->validate([

            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',

        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Successfully created user!'
        ]);
    }

    //LOGIN USUARIO (POST)
    public function login(Request $request)
    {

        $request->validate([

            'email' => 'required|string|email',

            'password' => 'required|string'

        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))

            return response()->json([

                'message' => 'Unauthorized'

            ], 401);

        $user = $request->user();

        $tokenResult = $user->createToken('token');

        $token = $tokenResult->token;

        $token->save();

        return response()->json([

            'access_token' => $tokenResult->accessToken,

            'token_type' => 'Bearer'

        ]);
    }

    //PERFIL DEL USUARIO (GET) -> NECESITA EL TOKEN
    public function get_user()
    {

        //return response()->json($request->user());

        $user = Auth::user();

        return response()->json([
            "status" => true,
            "message" => "profile information",
            "data" => $user,
            'token_type' => 'Bearer'
        ]);
    }

    //LOGOUT DEL USUARIO (GET) -> NECESITA EL TOKEN
    public function logout()
    {
        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "user logged out"
        ]);
    }


    //AÑADE PRODUCTOS AL CARRITO (POST) -> NECESITA TOKEN
    public function add_carrito(Request $request)
    {

        $user = Auth::user();

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
            'user_id' => $user->id,
        ]);

        $basket = Basket::where('basket.user_id', $user->id)
            ->join('articles', 'articles.id', '=', 'basket.article_id')
            ->select(
                'basket.*',
                'articles.name as NombreArticulo'
            )
            ->get();

        return response()->json([
            "message" => "Producto añadido a la cesta",
            "cesta" => $basket
        ]);
    }
}
