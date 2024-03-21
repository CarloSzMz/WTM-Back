@extends('layout.styles')
<div class="caja mt-2 mb-5">
    <form class="form_edicion" action="{{ route('users.store') }}" method="POST">
        @csrf
        <section class="d-flex justify-content-center align-items-center">
            <div class="card shadow col-xs-12 col-sm-6 col-md-6 col-lg-4   p-4">
                <div class="row">

                    <div class="col-lg-12">

                        <h2 class="text-center">Crear Usuario</h2>

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

                    <!-- Surname -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Apellidos:</strong>
                            <input type="text" name="surname"
                                class="form-control $errors->has('surname') ? 'error' : '' " placeholder="Apellidos">

                            <!-- Error Nombre Requerido -->
                            @if ($errors->has('surname'))
                                <p class="text-danger"> {{ $errors->first('surname') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- E-mail -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>E-mail:</strong>
                            <input type="email" name="email"
                                class="form-control $errors->has('email') ? 'error' : '' " placeholder="E-mail">

                            <!-- Error Email Requerido -->
                            @if ($errors->has('email'))
                                <p class="text-danger"> {{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Password:</strong>
                            <input type="password" name="password"
                                class="form-control $errors->has('password') ? 'error' : '' ">

                            <!-- Error Password Requerido -->
                            @if ($errors->has('password'))
                                <p class="text-danger"> {{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- pais -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Pais:</strong>
                            <input type="text" name="pais"
                                class="form-control $errors->has('pais') ? 'error' : '' " placeholder="Pais">

                            <!-- Error Nombre Requerido -->
                            @if ($errors->has('pais'))
                                <p class="text-danger"> {{ $errors->first('pais') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- provincia -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Provincia:</strong>
                            <input type="text" name="provincia"
                                class="form-control $errors->has('provincia') ? 'error' : '' " placeholder="Provincia">

                            <!-- Error Nombre Requerido -->
                            @if ($errors->has('provincia'))
                                <p class="text-danger"> {{ $errors->first('provincia') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- calle -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Calle:</strong>
                            <input type="text" name="calle"
                                class="form-control $errors->has('calle') ? 'error' : '' " placeholder="Calle">

                            <!-- Error Nombre Requerido -->
                            @if ($errors->has('calle'))
                                <p class="text-danger"> {{ $errors->first('calle') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Tipo -->
                    <div class="col-xs-12 col-sm-12 col-md-12 p-3">
                        <div class="form-group">
                            <strong>Tipo:</strong>

                            <select name="tipo" class="form-control $errors->has('tipo') ? 'error' : '' ">
                                <option selected disabled>Seleccione Tipo:</option>
                                <option value="0">Usuario</option>
                                <option value="1">Admin</option>
                            </select>

                            <!-- Error Tipo Requerido -->
                            @if ($errors->has('tipo'))
                                <p class="text-danger"> {{ $errors->first('tipo') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                        <button type="submit" class="btn btn-success float-left">Crear Usuario</button>
                    </div>
                </div>

            </div>
        </section>
    </form>
</div>
