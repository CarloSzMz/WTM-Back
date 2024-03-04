<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Stock;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles = Article::join('categories', 'categories.id', '=', 'articles.category_id')
            ->join('stock', 'stock.id', '=', 'articles.stock_id')
            ->select(
                'categories.name as Categoria',
                'stock.quantity as Cantidad',
                'articles.*',
            )
            ->paginate(10);

        // dd($entrenamientos);

        return view('article.index', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $articles = Article::get();

        $categorias = Category::get();

        $stock = Stock::get();

        //dd($articles);

        return view('article.create', compact('articles', 'categorias', 'stock'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'stock_id' => 'required',
        ]);

        Article::create([
            'name' => $request->name,
            'description' => $request->description,
            'url_img' => $request->url_img,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'stock_id' => $request->stock_id,
        ]);

        return redirect()->route('article.index')
            ->with('success', 'Articulo creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $article = Article::where('articles.id', $id)
            ->join('categories', 'categories.id', '=', 'articles.category_id')
            ->join('stock', 'stock.id', '=', 'articles.stock_id')
            ->select(
                'categories.name as Categoria',
                'stock.quantity as Cantidad',
                'stock.price as Precio',
                'articles.*',
            )->first();

        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $article = Article::join('categories', 'categories.id', '=', 'articles.category_id')
            ->join('stock', 'stock.id', '=', 'articles.stock_id')
            ->select(
                'articles.name as ArticleName',
                'articles.id as ArticleId',
                'articles.*'
            )->findOrFail($id);

        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $article = Article::findOrFail($id);
        //dd($request);
        $article->update([
            'name' => $request->name,
            'description' => $request->description,
            'url_img' => $request->url_img,
            'discount' => $request->discount,
        ]);

        return redirect()->route('article.index')
            ->with('success', 'Articulo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $articles = Article::findOrFail($id);
        $articles->delete();

        return redirect()->route('article.index')
            ->with('success', 'Articulo eliminado');
    }
}
