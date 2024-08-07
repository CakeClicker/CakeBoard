<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js', ])

    <!-- Additional Styles -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .flex-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .main-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            justify-items: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body class="bg-gray-700">
@if (Auth::check())
    <script>
        window.location.href = '{{ url('/login') }}';
    </script>
@endif

<div class="flex-container">
    <div class="navbar bg-base-100">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">Home</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><a>Link</a></li>
                <li>
                    <details>
                        <summary>Parent</summary>
                        <ul class="bg-base-100 rounded-t-none p-2">
                            <li><a>Link 1</a></li>
                            <li><a>Link 2</a></li>
                        </ul>
                    </details>
                </li>
            </ul>
        </div>
    </div>

    <main class="main-container">
        <div class="card bg-base-100 w-96 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Login</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <div class="card-actions justify-end">
                    <button onclick="window.location='{{ route('login') }}'" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 w-96 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Register</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <div class="card-actions justify-end">
                    <button onclick="window.location='{{ route('register') }}'" class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</div>
</body>
</html>
