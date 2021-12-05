<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'> --}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/theme-chooser.js') }}" defer></script>

    <!-- Fonts -->
    <link rel='stylesheet' type='text/css'
        href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.css' />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/d.png" height="60" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/home">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/records">{{ __('Records') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/payment">{{ __('Payments') }}</a>
                        </li>
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#exampleModal">
                            <i class="fa fa-plus" aria-hidden="true"></i> new Record
                        </button>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="continer">
                @if (session()->has('message'))
                    <div class="alert alert-info">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('home')
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </main>
    </div>
    <footer class="alert alert-danger" style="text-align: center">
        <hr>
        <img src="/d.png" height="40" alt="">
        <h6> © 2021 Copyright: 9davidmuia@gmail.com</h6>
    </footer>
</body>

<script>
    const bytitle = () => {
        console.log(document.getElementById('s_title').value);

        let fd = {
            data: document.getElementById('s_title').value
        }
        document.getElementById('s_title').value == '' ? document.getElementById('search').innerHTML = '' :
            fetch(`/api/search/title/${document.getElementById('s_title').value}`)
            .then(res => res.json())
            .then((res) => {
                console.log(res)
                let s = ' <div class="container"  >'
                res.forEach(element => {
                    s = s + ` <div class="card" style="margin-top: 20px;margin-bottom: 20px">
                        <div class="card-header">
                            <h5><b><u>Case Title: </u></b>  ${element.title }</h5>
                            <b><u>Case Location: </u></b> ${ element.location }
                            <b><u>Case Date: </u></b> ${ element.date }
                        </div>
                        <div class="card-body">
                            <p>
                                <b>Client Name: ${ element.clientname } </b><br>

                            <p class="card-text">
                               KES ${ element.amount }.
                            </p>
                            <p class="card-text">
                            </p>
                            <a href="/records/${ element.id }" class="btn btn-primary">View All</a>
                        </div>
                    </div>`

                });
                document.getElementById('search').innerHTML = s + '</div>'
            })
            .catch(err => {
                console.error(err)
            })
    }
</script>

</html>
