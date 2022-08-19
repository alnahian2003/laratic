<!DOCTYPE html>
<html lang="en" class="dark:bg-slate-800 dark:text-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    <title>
        @hasSection ('title')
            Laratic — @yield('title')
        @else
            Laravel Practice
        @endif
    </title>
</head>
<body class="px-3 bg-gray-800 text-gray-100">
        <header class="bg-gray-600">
            <nav>
                <ul class="flex py-4 flex-row justify-center align-middle gap-4">
                    <li><a class="hover:underline {{request()->routeIs('test.index') ? 'font-bold text-green-500' : ''}}" href="{{route('test.index')}}">Test Page</a></li>
                    
                    <li><a class="hover:underline {{request()->routeIs('test.create') ? 'font-bold text-green-500' : ''}}" href="{{route('test.create')}}">Upload / Form</a></li>
                </ul>
            </nav>
        </header>

        <hr>
    

    @yield('content')

    <footer class="my-32 text-center">&copy; {{$thisYear." ".$siteAuthor}}</footer>
</body>
</html>