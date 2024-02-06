<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/global.css') }}">
    
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    
    <!-- Styles -->
    @include('fragements.head')
</head>

<body>

<div class="container">

   <div id="main" class="row">

        @yield('content')

   </div>

   <footer class="row">

       @include('fragements.footer')

   </footer>
  
</div>

<!-- Scripts -->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>

</html>