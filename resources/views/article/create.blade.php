@extends('layout.styles')
<div class="caja mt-2 mb-5">
    <form class="form_edicion" action="{{ route('articles.store') }}" method="POST">
        @csrf
        <section class="d-flex justify-content-center align-items-center">
            <div class="card shadow col-xs-12 col-sm-6 col-md-6 col-lg-4   p-4">
                <div class="row">

                    <div class="col-lg-12">

                        <h2 class="text-center">Crear Articulo</h2>

                    </div>
                </div>

                <div class="row">

                    <!-- Nombre -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            <input type="text" name="name"
                                class="form-control $errors->has('name') ? 'error' : '' " placeholder="Nombre">

                            <!-- Error Nombre Requerido -->
                            @if ($errors->has('name'))
                                <p class="text-danger"> {{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            <input type="text" name="description"
                                class="form-control $errors->has('description') ? 'error' : '' "
                                placeholder="Descripcion">

                            <!-- Error description Requerido -->
                            @if ($errors->has('description'))
                                <p class="text-danger"> {{ $errors->first('description') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Imagen:</strong>
                            <input type="file" name="url_img"
                                class="form-control file-upload-wrapper $errors->has('url_img') ? 'error' : '' "
                                placeholder="url_img">

                            <!-- Error url_img Requerido -->
                            @if ($errors->has('url_img'))
                                <p class="text-danger"> {{ $errors->first('url_img') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Categoria:</strong>

                            <select name="category_id" class="form-control $errors->has('category_id') ? 'error' : '' ">
                                <option selected disabled>Seleccione Categoria:</option>
                                @foreach ($categorias as $item)
                                    <option value={{ $item->id }}>{{ $item->name }}</option>
                                @endforeach

                            </select>

                            <!-- Error category_id Requerido -->
                            @if ($errors->has('tipo'))
                                <p class="text-danger"> {{ $errors->first('category_id') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Stock:</strong>

                            <select name="stock_id" class="form-control $errors->has('stock_id') ? 'error' : '' ">
                                <option selected disabled>Seleccione Stock:</option>
                                @foreach ($stock as $item)
                                    <option value={{ $item->id }}>{{ $item->name }}</option>
                                @endforeach
                            </select>

                            <!-- Error stock_id Requerido -->
                            @if ($errors->has('stock_id'))
                                <p class="text-danger"> {{ $errors->first('stock_id') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                        <button type="submit" class="btn btn-success float-left">Crear Articulo</button>
                    </div>
                </div>

            </div>
        </section>
    </form>
</div>
