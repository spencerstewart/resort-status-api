<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME')}}</title>

    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <div class="container" id="app">
        <div class="row">
            <div class="col-md-8">@yield('content')</div>
            <div class="col-md-4">@yield('sidebar')</div>
        </div>
    </div>

    <script src="js/app.js"></script>

</body>
</html>