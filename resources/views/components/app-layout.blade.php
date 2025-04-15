<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/utils/onFormSubmit.js'])

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    <div class="w-full p-6 shadow-md rounded-xl">

        @isset($header)
            <div class="mb-4 text-xl font-semibold text-center text-gray-800">
                {{ $header }}
            </div>
        @endisset

        {{ $slot }}
    </div>
</body>

</html>
