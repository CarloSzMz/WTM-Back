@extends('layout.styles')

<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="container">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <section class="d-flex justify-content-center align-items-center">
                <div class="card shadow col-xs-12 col-sm-6 col-md-6 col-lg-4   p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="text-center">Actualizar Usuario</h2>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-start align-items-center">
                        <div class="row">

                            <!-- Nombre -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Nombre"
                                        value="{{ $user->name }}">

                                    <!-- Error Nombre Requerido -->
                                    @if ($errors->has('nombre'))
                                        <p class="text-danger"> {{ $errors->first('nombre') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input id="email" class="form-control  $errors->has('email') ? 'error' : '' "
                                        style="height:50px" name="email" value="{{ $user->email }}">

                                    <!-- Error Email Requerido -->
                                    @if ($errors->has('email'))
                                        <p class="text-danger"> {{ $errors->first('email') }} </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Pais -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Pais:</strong>
                                    <input type="text" name="pais" class="form-control" placeholder="Pais"
                                        value="{{ $user->pais }}">

                                    <!-- Error Nombre Requerido -->
                                    @if ($errors->has('pais'))
                                        <p class="text-danger"> {{ $errors->first('pais') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Provincia -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Provincia:</strong>
                                    <input type="text" name="provincia" class="form-control" placeholder="Provincia"
                                        value="{{ $user->provincia }}">

                                    <!-- Error Nombre Requerido -->
                                    @if ($errors->has('provincia'))
                                        <p class="text-danger"> {{ $errors->first('provincia') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Calle -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Calle:</strong>
                                    <input type="text" name="calle" class="form-control" placeholder="Calle"
                                        value="{{ $user->calle }}">

                                    <!-- Error Nombre Requerido -->
                                    @if ($errors->has('calle'))
                                        <p class="text-danger"> {{ $errors->first('calle') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Tipo -->
                            <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                                <div class="form-group">
                                    <strong>Tipo: </strong>
                                    @if ($user->tipo != 0)
                                        <?php $tipo = 'admin'; ?>
                                    @else
                                        <?php $tipo = 'normal'; ?>
                                    @endif
                                    <select name="tipo" class="form-control">
                                        <option value="{{ $user->tipo }}">
                                            Tipo Actual: {{ $tipo }}
                                        </option>
                                        <option value="0">Usuario</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-inline-flex row justify-content-center">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                            <button type="submit" class="btn btn-success float-left">Actualizar Usuario</button>

                            <a class="btn btn-primary float-right" href="{{ route('users.show', $user->id) }}"
                                title="Ver Usuarios">
                                Ver {{ $user->name }}
                            </a>
                        </div>
                    </div>
                    <a class="mt-3 btn btn-danger float-right" href="{{ route('users.index') }}" title="Ver Usuarios">
                        Cancelar </a>
                </div>
            </section>
        </form>
    </div>
</div>
