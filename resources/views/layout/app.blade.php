<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('public\css\bootstrap.css') }}">
    <link rel="icon" href="{{ asset('public\logo\logo-sign.svg') }}" type="image/x-icon">
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.5/vue.global.js"></script>
<script src="{{ asset('public\js\bootstrap.bundle.js') }}"></script>
@include('layout.navbar')
@yield('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
    p,h1,h2,h3,h4,h5,h6,span,div,a,button,label,input,option{
        font-family: "Jost", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }
    .bold{
        font-weight: 700;
    }
</style>
</body>
</html>
