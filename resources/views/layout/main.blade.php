<!DOCTYPE html>
<html lang="en">
@include('layout.styles')

<body>
    <header class="bg-dark d-flex text-light align-items-center">
       <a href="{{ route('users.index') }}"><img src="{{ asset('assets/img/logos/logo_white.png') }}" alt="logo" width="100px"></a> 
        <h1 class="white">Wear The Message</h1>
    </header>
    <div class="container mb-2">
        @include('layout.app')

    </div>
    

    <!-- Footer -->
    <footer class="sticky-footer bg-secondary">
        <div class="container my-auto">
            <div class="copyright text-center my-auto text-light">
                <span>Copyright &copy; WTM-backend 2024</span>
            </div>
        </div>
    </footer>
</body>

</html>
