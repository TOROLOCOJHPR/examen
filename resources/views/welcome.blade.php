<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>EasyCredit</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <style>
            html,body{
                height:100%;
            }
            .print{
                border:1px dashed red;
            }

        </style>
    </head>
    <body>
        <div id="login" class="h-100">
            <login-form></login-form>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
