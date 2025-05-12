<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Linglooma</title>
    <style>
        body{
            background-color: rgb(29, 6, 34)
        }
    </style>
</head>
<body>
    
    @include('layouts.navigation')    

    @yield('content')
    
    @include('layouts.footer')
   
</body>
</html>