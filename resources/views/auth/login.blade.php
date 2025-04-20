<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-blue-palette-lightest {
            background-color: #e0f7fa;
            /* Light Blue 50 (approximation) */
        }

        .bg-blue-palette-lighter {
            background-color: #b3e5fc;
            /* Light Blue 200 (approximation) */
        }

        .text-blue-palette-dark {
            color: #1976d2;
            /* Blue 700 (approximation) */
        }

        .border-blue-palette {
            border-color: #64b5f6;
            /* Blue 300 (approximation) */
        }

        .bg-blue-palette-button {
            background-color: #2196f3;
            /* Blue 500 (approximation) */
        }

        .bg-blue-palette-button:hover {
            background-color: #1e88e5;
            /* Blue 600 (approximation) */
        }

        .focus-blue-palette {
            --tw-ring-color: #90caf9;
            /* Blue 200 (approximation) */
            --tw-border-opacity: 1;
            border-color: rgba(144, 202, 249, var(--tw-border-opacity));
            --tw-ring-offset-shadow: var(--tw-shadow);
            --tw-ring-shadow: 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow);
        }

        .alert-success-blue-palette {
            color: #1565c0;
            background-color: #e3f2fd;
            border-color: #64b5f6;
        }
    </style>
</head>

<body class="bg-blue-palette-lightest rounded-full text-blue-palette-dark m-auto">
    <section
        class="flex justify-center items-center pt-28 pb-64 bg-blue-palette-lighter bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
        <div class="w-full max-w-sm p-8 rounded-lg shadow-lg bg-white border-2 border-blue-palette">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('img/WD.png') }}" alt="Logo" class="h-12">
            </div>
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                <h5 class="text-xl font-medium text-blue-palette-dark text-center">Login to Your Account</h5>
                @csrf
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email:</label>
                    <input type="text" id="email" name="email" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 focus-blue-palette">
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 focus-blue-palette">
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-palette-button hover:bg-blue-palette-button focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Sign in
                </button>
            </form>
            @if ($errors->any())
                <div class="mt-4 p-4 bg-red-800 text-red-300 rounded-lg">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif
        </div>
    </section>
</body>

</html>
