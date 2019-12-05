<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Northern Lights Technology Development Philippines Corporation</title>

    {{-- <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ config('app.env') === 'production' ? secure_asset('css/app.css') : asset('css/app.css') }}">
</head>
<body>
    <div id="app"></div>

    {{-- <script src="{{ secure_asset('js/app.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ config('app.env') === 'production' ? secure_asset('js/app.js') : asset('js/app.js') }}"></script>
</body>
</html>