<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/utils/onFormSubmit.js'])

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>

<body class="min-h-screen flex flex-col">
    <div class="w-full p-6 rounded-xl">

        @isset($header)
            <div class="mb-4 text-xl font-semibold text-center text-gray-800">
                {{ $header }}
            </div>
        @endisset

        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>
