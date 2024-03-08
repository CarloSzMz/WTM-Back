@extends('layout.styles')

<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="container">
        <form action="{{ route('basket.update', $basket->id) }}" method="POST">
            @csrf
            @method('PUT')

            <section class="d-flex justify-content-center align-items-center">
                <div class="card shadow col-xs-12 col-sm-6 col-md-6 col-lg-4   p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="text-center">Actualizar Cesta</h2>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-start align-items-center">
                        <div class="row">

                            <!-- article_id -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Artículo:</strong>
                                    <input type="text" name="articulo" class="form-control"
                                        placeholder="{{ $basket->NombreArticulo }}"
                                        value="{{ $basket->NombreArticulo }}" disabled>


                                    <!-- Error Nombre Requerido -->
                                    @if ($errors->has('article_id'))
                                        <p class="text-danger"> {{ $errors->first('article_id') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Cantidad -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Cantidad:</strong>
                                    <input class="form-control" style="height:50px" name="quantity"
                                        value="{{ $basket->quantity }}" type="number">

                                    <!-- Error Cantidad Requerido -->
                                    @if ($errors->has('quantity'))
                                        <p class="text-danger"> {{ $errors->first('quantity') }} </p>
                                    @endif
                                </div>
                            </div>

                            <!-- User -->
                            <div class="d-none">
                                <div class="form-group">
                                    <strong>user:</strong>
                                    <input type="text" name="user_id"
                                        class="form-control $errors->has('user_id') ? 'error' : '' "
                                        placeholder="user_id" value="{{ $basket->user_id }}">
                                    <option value={{ $basket->user_id }}></option>
                                </div>
                            </div>
                            <!-- article_id -->
                            <div class="d-none">
                                <div class="form-group">
                                    <strong>Artículo:</strong>
                                    <input type="text" name="article_id" class="form-control"
                                        placeholder="{{ $basket->article_id }}" value="{{ $basket->article_id }}">
                                    <option value={{ $basket->article_id }}></option>


                                    <!-- Error Nombre Requerido -->
                                    @if ($errors->has('article_id'))
                                        <p class="text-danger"> {{ $errors->first('article_id') }}</p>
                                    @endif
                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="d-inline-flex row justify-content-center">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <button type="submit" class="btn btn-success float-left">Actualizar Cesta</button>
                        </div>
                    </div>
                    <a class="mt-3 btn btn-danger float-right" href="{{ route('stock.index') }}" title="Ver Stock">
                        Cancelar </a>
                </div>
            </section>
        </form>
    </div>
</div>
