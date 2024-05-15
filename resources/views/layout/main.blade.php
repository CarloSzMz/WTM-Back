<!DOCTYPE html>
<html lang="en">
@include('layout.styles')

<!--
<body>
    <header class="bg-dark d-flex text-light align-items-center">
        <a href="{{ route('users.index') }}"><img src="{{ asset('assets/img/logos/logo_white.png') }}" alt="logo"
                width="100px"></a>
        <h1 class="white">Wear The Message</h1>
    </header>

</body>
-->

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm  text-light ">
            <a href="{{ route('users.index') }}"><img src="{{ asset('assets/img/logos/logo_white.png') }}" alt="logo"
                    width="100px"></a>
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-row" style="height: 1500px;">
            <nav class="col-md-3 col-lg-2 d-md-block bg-primary sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column mt-4" style="padding-left: 8%;">
                        <li class="nav-item">
                            <a class="nav-link active text-dark d-flex flex-row w-100 justify-content-between"
                                href="{{ route('users.index') }}">
                                <span class="text-light fw-bold">Usuarios</span>
                                <i class="gg-user text-light"></i>
                            </a>
                        </li>
                        <hr style="color: black;">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-dark d-flex flex-row w-100 justify-content-between"
                                href="#ropaSubmenu" data-bs-toggle="collapse" aria-expanded="false"
                                id="ropaSubmenuLink">
                                <span class="text-light fw-bold">Almacén</span>
                                <i class="gg-arrow-down text-light" id="ropaSubmenuIcon"></i>
                                <!-- Añadimos un ID para identificar este icono -->
                            </a>
                            <div class="collapse" id="ropaSubmenu" style="margin-left: 16px;">
                                <!-- Ajuste de margen izquierdo -->
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link active text-dark d-flex flex-row w-100 justify-content-between"
                                            href="{{ route('article.index') }}">
                                            <span class="text-light">Artículos</span>
                                            <i class="gg-awards"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active text-dark d-flex flex-row w-100 justify-content-between"
                                            href="{{ route('stock.index') }}">
                                            <span class="text-light">Stock</span>
                                            <i class="gg-awards"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active text-dark d-flex flex-row w-100 justify-content-between"
                                            href="{{ route('category.index') }}">
                                            <span class="text-light">Categorías</span>
                                            <i class="gg-awards"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <hr style="color: black;">
                        <li class="nav-item">
                            <a class="nav-link active text-dark d-flex flex-row w-100 justify-content-between"
                                href="{{ route('order.index') }}">
                                <span class="text-light fw-bold">Pedidos</span>
                                <i class="gg-notes text-light"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="py-4 w-100" style="background-color: #E3F5F6; ">
                @include('layout.app')
            </main>
        </div>
    </div>
</body>

</html>
