@extends('layout.styles')

<div class="d-flex justify-content-center align-items-center h-100 w-100 bg-primary-subtle">
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="container">
        <form action="{{ route('articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')

            <section class="d-flex justify-content-center align-items-center">
                <div class="card shadow col-xs-12 col-sm-6 col-md-6 col-lg-4   p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="text-center">Actualizar Artículo</h2>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-start align-items-center">
                        <div class="row">

                            <!-- Nombre -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>*Nombre:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Nombre"
                                        value="{{ $article->name }}">

                                    <!-- Error Nombre Requerido -->
                                    @if ($errors->has('nombre'))
                                        <p class="text-danger"> {{ $errors->first('nombre') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- description -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>*Descripcion:</strong>
                                    <input id="description"
                                        class="form-control  $errors->has('description') ? 'error' : '' "
                                        style="height:50px" name="description" value="{{ $article->description }}">

                                    <!-- Error Email Requerido -->
                                    @if ($errors->has('description'))
                                        <p class="text-danger"> {{ $errors->first('description') }} </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Image -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>*Imagen:</strong>
                                    <input type="file" name="url_img"
                                        class="form-control file-upload-wrapper $errors->has('url_img') ? 'error' : '' "
                                        placeholder="url_img" value="{{ $article->url_img }}">

                                    <!-- Error url_img Requerido -->
                                    @if ($errors->has('url_img'))
                                        <p class="text-danger">
                                            {{ $errors->first('url_img') }}</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="d-inline-flex row justify-content-center">
                        <div class="d-flex flex-row p-2">
                            <button type="submit" class="btn btn-success float-left w-50 m-2">Actualizar Artículo</button>
                            <button class="btn btn-primary w-50 m-2">
                                <a class="float-right text-light text-decoration-none"
                                    href="{{ route('articles.show', $article->id) }}" title="Ver Articulo">
                                    Ver Detalles
                                </a>
                            </button>
                        </div>
                    </div>
                    <a class="mt-3 btn btn-danger float-right" href="{{ route('article.index') }}" title="Ver Usuarios">
                        Cancelar </a>
                </div>
            </section>
        </form>
    </div>
</div>
