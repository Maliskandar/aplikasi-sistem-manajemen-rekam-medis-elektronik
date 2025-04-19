@extends('admin.layout')

@section('content')
    <div class="container">
        <!-- Breadcrumbs Start -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse mb-2">
                <li class="inline-flex items-center">
                    <a href="/admin/dashboard"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                    </a>
                </li>
                {{-- <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Users</a>
                </div>
            </li> --}}
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Daftar
                            Reservasi</span>
                    </div>
                </li>
            </ol>
        </nav>
        <!-- Breadcrumbs End -->
        <h1 class="text-2xl font-bold mb-4 text-gray-700 dark:text-gray-400">Daftar Reservasi</h1>
        <table
            class="text-gray-500 text-sm rounded-lg focus:ring-blue-500 dark:bg-transparent dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 w-full p-2.5">
            <thead>
                <tr>
                    <th
                        class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                        No</th>
                    <th
                        class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                        Nama Customer</th>
                    <th
                        class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                        Nama Kucing</th>
                    <th
                        class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                        Kandang</th>
                    <th
                        class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                        Status</th>
                    <th
                        class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                        Status Pembayaran</th>
                    <th
                        class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                        Tanggal Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservasi as $key => $item)
                    <tr class="dark:hover:bg-gray-700 hover:bg-gray-100">
                        <td
                            class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                            {{ $key + 1 }}</td>
                        <td
                            class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                            {{ $item->customer->nama }}</td>
                        <td
                            class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                            {{ $item->kucing->nama }}</td>
                        <td
                            class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                            {{ $item->kandang->ukuran }}</td>
                        <td
                            class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                            <span
                                class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                {{ $item->status }}
                            </span>
                        </td>
                        <td
                            class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                            <span
                                class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                {{ $item->status_pembayaran }}
                            </span>
                        </td>
                        <td
                            class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                            {{ $item->tanggal_pembayaran ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
