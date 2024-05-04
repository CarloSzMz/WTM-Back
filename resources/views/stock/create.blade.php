@extends('layout.styles')
<div class="caja mt-2 mb-5">
    <form class="form_edicion" action="{{ route('stock.store') }}" method="POST">
        @csrf
        <section class="d-flex justify-content-center align-items-center">
            <div class="card shadow col-xs-12 col-sm-6 col-md-6 col-lg-4   p-4">
                <div class="row">

                    <div class="col-lg-12">

                        <h2 class="text-center">Crear Stock</h2>

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

                    <!-- Cantidad -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            <input type="number" name="quantity"
                                class="form-control $errors->has('quantity') ? 'error' : '' "
                                placeholder="Cantidad (ud)">

                            <!-- Error Cantidad Requerido -->
                            @if ($errors->has('quantity'))
                                <p class="text-danger"> {{ $errors->first('quantity') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Precio -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Precio:</strong>
                            <input type="text" step="any" pattern="[0-9]+([\.,][0-9]+)?" name="price"
                                class="form-control $errors->has('price') ? 'error' : '' ">

                            <!-- Error Precio Requerido -->
                            @if ($errors->has('price'))
                                <p class="text-danger"> {{ $errors->first('price') }}</p>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                        <button type="submit" class="btn btn-success float-left">Crear Stock</button>
                    </div>
                </div>
            </div>



</div>
</section>
</form>
</div>
