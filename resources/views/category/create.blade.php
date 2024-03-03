@extends('layout.styles')
<div class="caja mt-2 mb-5">
    <form class="form_edicion" action="{{ route('category.store') }}" method="POST">
        @csrf
        <section class="d-flex justify-content-center align-items-center">
            <div class="card shadow col-xs-12 col-sm-6 col-md-6 col-lg-4   p-4">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-center">Crear Categoria</h2>
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

                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                        <button type="submit" class="btn btn-success float-left">Crear Categoria</button>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
