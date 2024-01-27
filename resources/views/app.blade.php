<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600,700" rel="stylesheet">
    @vite('resources/css/app.css')
    @inertiaHead
</head>

<body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased">
@inertia

@vite('resources/js/app.js')
</body>

</html>
