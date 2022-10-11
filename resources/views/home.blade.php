<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-slate-100">
    <header>
        <nav class="bg-blue-500 text-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="https://flowbite.com" class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">TODO App</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="flex items-center lg:order-2">
                    @csrf
                    <button type="submit" class="text-white-800 dark:text-white hover:bg-blue-700 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Déconnexion</button>
                </form>
            </div>
        </nav>
    </header>
    <div id="app">
        <div class="">
            <create-task></create-task>
            <list-tasks></list-tasks>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>