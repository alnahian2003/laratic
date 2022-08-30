<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/js/app.js')
    <title>404 Not Found</title>
</head>
<body class="p-2 text-center">
    <figure class="mt-8">
        <img class="mx-auto max-w-lg rounded-lg" src="https://i.imgflip.com/34is30.jpg" alt="404 Not Found">
    </figure>
    <button class="my-8 btn btn-success" onclick="window.location='{{ route('posts.index') }}'">🔙 Return to Home</button>
</body>
</html>