@extends('layout.main')
@section('content')
    <div class="m-5 bg-light w-75">
        <div class="w-100 bg-secondary p-2 text-light">
            <h2> Detalle de Artículo </h2>
        </div>
        <div class="mx-auto mb-2 mt-4 d-flex flex-row">
            <div class="w-25 p-3">
                <img src="{{ asset("assets/img/camisetas/$article->url_img ") }}"
                    style=" object-fit: cover; height: 100%;  width: 100%;" alt="imgen" width="100px" class="center"><br>
            </div>
            <div class="w-50 p-3 h-100">
                <h2>Datos</h2>
                <div class="container">
                    <h6>Nombre: {{ $article->name }} </h6>
                    <h6>Descripción (opcional): {{ $article->description }}</h6>
                    <h6>Precio: {{ $article->Precio }}€</h6>
                </div>
            </div>
            <div class="w-25 p-3 d-flex flex-column">
                <div>
                    <div class="d-flex flex-row align-items-center">
                        <h2 style="margin-right: 10px">Stock</h2>
                        <i class="gg-box"></i>
                    </div>
                    <div class="container">
                        <h6>Productos en stock: {{ $article->Cantidad }}</h6>
                        <button class="btn btn-primary m-2"><a href="{{ route('stock.index') }}"
                                class="text-decoration-none text-light">Ir a Stock</a></button>
                    </div>
                </div>
                <hr style="color: black;">
                <div class="mt-3">
                    <div class="d-flex flex-row align-items-center">
                        <h2 style="margin-right: 10px">Categoría</h2>
                        <i class="gg-album"></i>
                    </div>
                    <div class="container">
                        <h6>Categoria: {{ $article->Categoria }}</h6>
                        <button class="btn btn-primary m-2"><a href="{{ route('category.index') }}"
                                class="text-decoration-none text-light">Ir a Categorías</a></button>
                    </div>
                </div>
            </div>


        </div>
        <button class="btn btn-primary m-2"><a href="{{ route('article.index') }}"
                class="text-decoration-none text-light">Volver</a></button>
    </div>
@endsection
