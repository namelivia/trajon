<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}" />
        <title>@yield('title')</title>
    </head>
    <body>
        <main class="container mt-5 mb-6">
            {{$email}}
			@yield('content')
        </main>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
