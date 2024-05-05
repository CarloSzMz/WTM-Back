@extends('layout.styles')

<div class="d-flex justify-content-center align-items-center h-100 w-100 bg-primary-subtle">
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="container">
        <form action="{{ route('stock.update', $stock->id) }}" method="POST">
            @csrf
            @method('PUT')

            <section class="d-flex justify-content-center align-items-center">
                <div class="card shadow col-xs-12 col-sm-6 col-md-6 col-lg-4   p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="text-center">Actualizar Stock</h2>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-start align-items-center">
                        <div class="row">

                            <!-- Nombre -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Nombre"
                                        value="{{ $stock->name }}" disabled>

                                    <!-- Error Nombre Requerido -->
                                    @if ($errors->has('nombre'))
                                        <p class="text-danger"> {{ $errors->first('nombre') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Cantidad -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Cantidad:</strong>
                                    <input class="form-control" style="height:50px" name="quantity"
                                        value="{{ $stock->quantity }}" type="number">

                                    <!-- Error Cantidad Requerido -->
                                    @if ($errors->has('quantity'))
                                        <p class="text-danger"> {{ $errors->first('quantity') }} </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Precio -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Precio:</strong>
                                    <input type="text" step="any" pattern="[0-9]+([\.,][0-9]+)?" name="price" class="form-control" placeholder="Precio €"
                                        value="{{ $stock->price }}">

                                    <!-- Error Nombre Requerido -->
                                    @if ($errors->has('price'))
                                        <p class="text-danger"> {{ $errors->first('price') }}</p>
                                    @endif
                                </div>
                            </div>




                        </div>
                    </div>

                    <div class="d-inline-flex row justify-content-center align-items-center">
                            <button type="submit" class="btn btn-success float-left w-50">Actualizar Stock</button>                           
                    </div>
                    <a class="mt-3 btn btn-danger float-right" href="{{ route('stock.index') }}" title="Ver Stock">
                        Cancelar </a>
                </div>
            </section>
        </form>
    </div>
</div>
