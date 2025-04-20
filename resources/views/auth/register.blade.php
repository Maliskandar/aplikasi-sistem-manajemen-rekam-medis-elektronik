<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <section class="flex justify-center items-center pt-12 pb-12">
        <div class="w-full max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md">
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                <h5 class="text-xl font-medium text-gray-900">Sign in to our platform</h5>
                @csrf

                <div>
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama:</label>
                    <input type="text" id="nama" name="nama" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div>
                    <label for="info_kontak" class="block mb-2 text-sm font-medium text-gray-900">Info Kontak:</label>
                    <input type="text" id="info_kontak" name="info_kontak" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email:</label>
                    <input type="email" id="email" name="email" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username:</label>
                    <input type="text" id="username" name="username" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password:</label>
                    <input type="password" id="password" name="password" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Register
                </button>
                <p>Sudah punya akun? <a class="text-blue-700" href="/login">Login</a></p>
            </form>

            @if ($errors->any())
                <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>
</body>

</html>
