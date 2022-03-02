<!DOCTYPE html>
<html>
<head><title>{{ isset($title) ? $title:  'Laravel Test App'}} </title>
    <style>
        body{
            background-color: whitesmoke;
            background: linear-gradient(whitesmoke, whitesmoke);
            height: 100vh;
        }
    </style>
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css">
    <!-- Theme style -->
{{--    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">--}}
    @stack('head')
</head>
<body>
<div class="container">
    @auth
        <div class="row">
            <div class="col-md-12 text-right">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf()
            <input type="submit" class="btn btn-link" value="Log out">
            </form>
            </div>
        </div>
    @endauth
@if(session('error'))
    <div class="row">
        <div class="col-md-12 alert alert-danger">{{ session('error') }}
        <i style="cursor: pointer; float: right !important;" data-dismiss="alert"> &times;</i>
        </div>
    </div>
    @endif
    @if(session('success'))
        <div class="row">
            <div class="col-md-12 alert alert-success">{{ session('success') }}
                <i  style="cursor: pointer; float: right !important;" data-dismiss="alert"> &times;</i>
            </div>
        </div>
    @endif
    @yield('content')
</div>

<script src="{{ asset('js/jQuery.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
@stack('script')
</body>

</html>
