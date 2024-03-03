@extends('layout.main')
@section('content')
    <div class="container mt-4">
        <div class="d-block mx-auto mb-2 mt-4">
            <h1>Artículo</h1>
            <h2>{{ $article->name }} </h2>
            <h3>{{ $article->description }}</h3>
            <p>Categoria: {{ $article->Categoria }}</p>
            <p>Productos en stock: {{ $article->Cantidad }}</p>
            <img src="{{ asset("assets/img/camisetas/$article->url_img ") }}" alt="imgen" width="100px" class="center"><br>
            <p>Precio: {{ $article->Precio }}€</p>
            <p>Descuento: {{ $article->discount }}%</p>
            <button><a href="./">Volver</a></button>
        </div>
    </div>
@endsection
