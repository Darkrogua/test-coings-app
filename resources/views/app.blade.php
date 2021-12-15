<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coings @darkrogua</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/primevue.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <img src="{{ asset('images/logo.svg') }}" alt="Coings">
        <h1>coings</h1>
    </header>
    <div class="container-app">
        <div id="app">
            <coings></coings>
        </div>
    </div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
