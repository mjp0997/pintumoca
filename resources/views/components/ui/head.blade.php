<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestor de inventario</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

@yield('head')

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<!-- Page 404 -->
<link rel='stylesheet' href='{{ asset('css/page-404.css') }}'>

<!-- Custom general styles -->
<link rel='stylesheet' href='{{ asset('css/utilities.css') }}'>
<link rel='stylesheet' href='{{ asset('css/modal.css') }}'>
<link rel='stylesheet' href='{{ asset('css/custom-sidebar.css') }}'>

@yield('custom-head')

<meta name="csrf" content="{{ csrf_token() }}" id="meta-csrf">