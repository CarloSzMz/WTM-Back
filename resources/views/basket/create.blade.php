@extends('layout.styles')
<div class="caja mt-2 mb-5">
    <form class="form_edicion" action="{{ route('basket.store') }}" method="POST">
        @csrf
        <section class="d-flex justify-content-center align-items-center">
            <div class="card shadow col-xs-12 col-sm-6 col-md-6 col-lg-4   p-4">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-center">Añadir Producto</h2>
                    </div>
                </div>
                <div class="row">

                    <!-- Articulo -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Artículo:</strong>

                            <select name="article_id" class="form-control $errors->has('article_id') ? 'error' : '' ">
                                <option selected disabled>Seleccione Articulo:</option>
                                @foreach ($articles as $item)
                                    <option value={{ $item->id }}>{{ $item->name }} Precio: {{ $item->Precio }}
                                    </option>
                                @endforeach

                            </select>

                            <!-- Error article_id Requerido -->
                            @if ($errors->has('article_id'))
                                <p class="text-danger"> {{ $errors->first('article_id') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Cantidad -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            <input type="number" name="quantity"
                                class="form-control $errors->has('quantity') ? 'error' : '' " placeholder="Cantidad">

                            <!-- Error Nombre Requerido -->
                            @if ($errors->has('quantity'))
                                <p class="text-danger"> {{ $errors->first('quantity') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- User -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3 d-none">
                        <div class="form-group">
                            <strong>user:</strong>
                            <input type="text" name="user_id"
                                class="form-control $errors->has('user_id') ? 'error' : '' " placeholder="user_id"
                                value="{{ $user->id }}">
                            <option value={{ $user->id }}></option>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                        <button type="submit" class="btn btn-success float-left">Añadir Producto</button>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
