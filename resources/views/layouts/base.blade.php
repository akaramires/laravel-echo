<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        window.App = <?php echo json_encode( [ 'user' => auth()->user() ] ); ?>;
    </script>
</head>
<body>
<nav class="nav-main d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <a href="{{ url('/') }}" class="my-0 mr-md-auto font-weight-normal nav-main-brand">{{ config('app.name') }}</a>
    <nav class="my-2 my-md-0 mr-md-3">
        @guest
            <a class="p-2 text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
        @else
            <a class="p-2 text-dark" href="#">{{ auth()->user()->name }}</a>
            <a class="p-2 text-dark" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                @csrf
            </form>
        @endguest
    </nav>
    @guest
        <a class="btn btn-outline-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
    @endguest
</nav>

<div class="container">
    {{--@auth
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">{{ config('app.name') }}</h1>
            <p class="lead">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci amet at cumque cupiditate deleniti
                dolore
                eius et fugit harum magni, nihil rem sed sint sit tempore temporibus totam unde voluptatem.
            </p>
        </div>
    @endauth--}}

    <main id="app">
        @yield('base_content')
    </main>

    {{--<footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <img class="mb-2" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="24"
                     height="24">
                <small class="d-block mb-3 text-muted">&copy; {{ date('Y') }}</small>
            </div>
            <div class="col-6 col-md">
                <h5>Features</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Cool stuff</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Resource</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Team</a></li>
                </ul>
            </div>
        </div>
    </footer>--}}
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
