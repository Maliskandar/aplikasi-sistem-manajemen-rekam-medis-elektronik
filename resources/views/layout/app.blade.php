<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            animation: fadeIn 0.5s ease-out;
            /* Sesuaikan durasi dan fungsi timing sesuai kebutuhan */
        }
    </style>
</head>

<!-- Header -->
<header class="p-5 flex justify-between items-center bg-gray-800">
    <!-- Logo -->
    <div class="flex items-center">
        <img src="img/WD.png" alt="WAROENG GAME Logo" class="h-6 w-auto lg:h-8">
        <span class="ml-3 text-xl font-bold text-blue-700 lg:text-2xl">Waroeng Digital</span>
    </div>
    <a href="/login"
        class="relative inline-flex items-center justify-center px-8 py-2.5 overflow-hidden tracking-tighter text-white bg-gray-800 rounded-md group">
        <span
            class="absolute w-0 h-0 transition-all duration-500 ease-out bg-gradient-to-r from-blue-300 via-blue-500 to-purple-600 rounded-full group-hover:w-56 group-hover:h-56"></span>
        <span class="absolute bottom-0 left-0 h-full -ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-auto h-full opacity-100 object-stretch"
                viewBox="0 0 487 487">
                <path fill-opacity=".1" fill-rule="nonzero" fill="#FFF"
                    d="M0 .3c67 2.1 134.1 4.3 186.3 37 52.2 32.7 89.6 95.8 112.8 150.6 23.2 54.8 32.3 101.4 61.2 149.9 28.9 48.4 77.7 98.8 126.4 149.2H0V.3z">
                </path>
            </svg>
        </span>
        <span class="absolute top-0 right-0 w-12 h-full -mr-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="object-cover w-full h-full" viewBox="0 0 487 487">
                <path fill-opacity=".1" fill-rule="nonzero" fill="#FFF"
                    d="M487 486.7c-66.1-3.6-132.3-7.3-186.3-37s-95.9-85.3-126.2-137.2c-30.4-51.8-49.3-99.9-76.5-151.4C70.9 109.6 35.6 54.8.3 0H487v486.7z">
                </path>
            </svg>
        </span>
        <span
            class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-gray-200"></span>
        <span class="relative text-base font-semibold">Login</span>
    </a>
</header>

<body class="bg-gray-900 text-white">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        @yield('content')
    </div>
</body>

</html>
