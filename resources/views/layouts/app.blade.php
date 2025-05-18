<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

    <title>Linglooma</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: "Josefin Sans", sans-serif;
        }
    </style>
</head>
<body class="bg-[#231735] text-[#f8f7b8] font-bold" style="font-family: 'Josefin Sans', sans-serif;">

    @include('layouts.navigation')    

    <div class="flex h-[calc(100vh-100px)] overflow-hidden">
        @include('layouts.sidebar')

        <div class="flex-1 p-5 overflow-y-auto text-shadow">
            @yield('content')
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>
