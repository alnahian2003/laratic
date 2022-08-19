<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Name - @yield('title')</title>

    @vite('resources/js/app.js')
</head>
<body>
    @section('sidebar')
        <div class="container p-10 text-primary-content bg-primary mx-auto">This is the master sidebar.
            @show
        </div>
    

    <div class="container mx-auto p-10 text-success-content bg-success">
        @yield('content')
    </div>

    @section('footer')
    <div class="container mx-auto p-10 text-error-content bg-error">
        @yield('footer-message')
        @show
        <br> &copy;Copyrights {{date('Y')}} — Al Nahian
        
    </div>

    {{-- @stack('scripts') --}}
</body>
</html>