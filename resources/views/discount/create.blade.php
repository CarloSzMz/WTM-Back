@extends('layout.main')
@section('content')
    <div class="m-5">
        <form class="form_edicion" action="{{ route('discount.store') }}" method="POST">
            @csrf
            <section class="d-flex justify-content-center align-items-center">
                <div class="card shadow col-xs-12 col-sm-6 col-md-6 col-lg-4 p-4 w-100">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="text-center">Crear Descuento</h2>
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
                        <!-- Descuento -->
                        <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                            <div class="form-group">
                                <strong>Descuento:</strong>
                                <input type="number" name="discount"
                                    class="form-control $errors->has('discount') ? 'error' : '' " placeholder="Descuento %">
                                <!-- Error Nombre Requerido -->
                                @if ($errors->has('discount'))
                                    <p class="text-danger"> {{ $errors->first('discount') }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- Estado -->
                        <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                            <div class="form-group">
                                <strong>Estado:</strong>
                                <select name="active" class="form-control $errors->has('active') ? 'error' : '' ">
                                    <option selected value="0">Inactivo</option>
                                    <option value="1">Activo</option>
                                </select>
                                <!-- Error Tipo Requerido -->
                                @if ($errors->has('active'))
                                    <p class="text-danger"> {{ $errors->first('active') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                            <button type="submit" class="btn btn-success float-left">Crear Descuento</button>
                            <button class="btn btn-danger float-left">
                                <a href="{{ route('discount.index') }}" class="text-decoration-none text-light">Cancelar</a>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection
