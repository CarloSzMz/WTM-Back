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
    <div id="app ">
        <nav class="navbar navbar-expand-md navbar-light bg-secondary shadow-sm  text-light ">
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Navbar content -->
            <div class="container-md">
                <a class="navbar-brand" href="{{ route('users.index') }} ">Usuarios</a>
                <a class="navbar-brand" href="{{ route('article.index') }}">Articulos</a>
                <a class="navbar-brand" href="{{ route('stock.index') }}">Stock</a>
                <a class="navbar-brand" href="{{ route('category.index') }}">Categorias</a>
                <a class="navbar-brand" href="{{ route('order.index') }}">Pedidos</a>

            </div>
        </nav>

        <main class="py-4" style="background-color: #E3F5F6; height: 100vh;">
            @include('layout.app')
        </main>
    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-secondary">
        <div class="container my-auto">
            <div class="copyright text-center my-auto text-light pt-4 pb-4">
                <span>Copyright &copy; WTM-backend 2024</span>
            </div>
        </div>
    </footer>
</body>

</html>
