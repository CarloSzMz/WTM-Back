<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Order_Article;
use App\Models\Stock;
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

    //EDITA PRODUCTOS DEL CARRITO (PUT) -> NECESITA TOKEN
    public function update_carrito(Request $request)
    {
        $user = Auth::user();

        //dd($request);
        $request->validate([
            'basquet_id' => 'required',
            'quantity' => 'required',
        ]);

        $basket = Basket::where('id', $request->basquet_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $base_price = $basket->total / $basket->quantity;
        $new_total = $base_price * $request->quantity;

        $basket->update([
            'quantity' => $request->quantity,
            'total' => $new_total
        ]);

        return response()->json([
            "message" => "articulo de la cesta actualizado con éxito",
            "nuevoCarro" => $basket,
        ]);
    }

    //VER LOS PRODUCTOS DEL CARRITO (GET) -> NECESITA TOKEN
    public function ver_carrito()
    {

        $user = Auth::user();
        $basket = Basket::where('basket.user_id', $user->id)
            ->join('articles', 'articles.id', '=', 'basket.article_id')
            ->select(
                'basket.*',
                'basket.id as IdCesta',
                'articles.name as NombreArticulo',
                'articles.url_img as ImgArticulo',
            )
            ->get();

        return response()->json([
            "data" => $basket,
        ]);
    }

    //VER LOS PEDIDOS (GET) -> NECESITA TOKEN
    public function ver_pedidos()
    {

        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
            ->get();

        return response()->json([
            "data" => $orders,
        ]);
    }

    //VER LOS DETALLES DE UN PEDIDO (GET) -> NECESITA TOKEN
    public function ver_Detalle_pedido(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'order_id' => 'required',
        ]);

        $orderArticles = Order_Article::where('order_id', $request->order_id)
            ->join('articles', 'articles.id', '=', 'article_id')
            ->leftjoin('stock', 'stock.id', '=', 'articles.stock_id')
            ->select(
                'orders_articles.*',
                'articles.*',
                'stock.price'
            )
            ->get();
        $orders = Order::where('order.user_id', $user->id)
            ->join('articles', 'articles.id', '=', 'basket.article_id')
            ->select(
                'basket.*',
                'basket.id as IdCesta',
                'articles.name as NombreArticulo',
                'articles.url_img as ImgArticulo',
            )
            ->get();

        return response()->json([
            "data" => $orders,
        ]);
    }

    //CREAR UN PEDIDO (POST) -> NECESITA TOKEN
    public function create_pedido(Request $request)
    {
        $user = Auth::user();

        Order::create([
            'user_id' => $user->id,
            'total_price' => $request->total_price,
            'status' => 1
        ]);

        $pedido = Order::where('user_id', $user->id)->latest()->first();


        /**/

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


        Basket::where('user_id', $user->id)->delete();

        return response()->json([
            "message" => "pedido realizado con éxito",
            "data" => $pedido,
        ]);
    }

    //VISUALIZAR PEDIDO ESPECIFICO (POST) -> NECESITA TOKEN
    public function ver_pedido_especifico(Request $request)
    {
        $user = Auth::user();

        $pedido = Order::where('orders.id', $request->pedido_id)
            ->join('users', 'users.id', '=', 'user_id')
            ->select(
                'orders.*',
                'users.*',
                'orders.id as OrderId'
            )
            ->first();

        $orderArticles = Order_Article::where('order_id', $request->pedido_id)
            ->join('articles', 'articles.id', '=', 'article_id')
            ->leftjoin('stock', 'stock.id', '=', 'articles.stock_id')
            ->select(
                'orders_articles.*',
                'articles.*',
                'stock.price'
            )
            ->get();  //Articulos del pedido
        //dd($orderArticles);

        return response()->json([
            "Pedido" => $pedido,
            "ArticulosPedido" => $orderArticles
        ]);
    }


    //ACTUALIZAR DATOS DEL USUARIO (PUT) -> NECESITA TOKEN
    public function update_user(Request $request)
    {
        $user = Auth::user();

        $usuario = User::where('id', $user->id);

        $usuario->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'provincia' => $request->provincia,
            'calle' => $request->calle,
        ]);

        return response()->json([
            "message" => "usuario actualizado con éxito",
            "data" => $user,
        ]);
    }

    //ELIMINAR PRODUCTO DEL CARRITO (POST) -> NECESITA TOKEN
    public function eliminarProdCarrito(Request $request)
    {
        $user = Auth::user();

        $basket = Basket::findOrFail($request->id);
        $basket->delete();

        return response()->json([
            "message" => "cesta del usuario actualizada con éxito",
            "user" => $user,
            "basket" => $basket
        ]);
    }
}
