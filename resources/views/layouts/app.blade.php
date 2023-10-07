<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ route('home') }}/css/bootstrap.min.css">
</head>
<body>
@if(isset($header))
    @include('partials.header')
@endif
@yield('about')
@yield('content')
<script src="{{ route('home') }}/js/jquery-1.11.3.js"></script>
@if(isset($scripts))
    {{ $scripts }}
@endif
</body>
</html>
