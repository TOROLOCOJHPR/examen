<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Panel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">

    </head>
    <body class="text-dark">
        
        <div id="app">
            <contenedor-principal></contenedor-principal>    
        </div><!-- app -->
        
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>