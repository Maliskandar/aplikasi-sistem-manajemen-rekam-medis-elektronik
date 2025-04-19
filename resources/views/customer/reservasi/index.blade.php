@extends('layouts.app')

@section('content')
    <!-- Breadcrumbs Start -->
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse mb-2">
            <li class="inline-flex items-center">
                <a href="/customer/dashboard"
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
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Daftar Reservasi</span>
                </div>
            </li>
        </ol>
    </nav>
    <!-- Breadcrumbs End -->
    <h1 class="text-2xl font-bold mb-4 text-gray-700 dark:text-gray-400">Daftar Reservasi</h1>

    <!-- Tombol Buat Reservasi Baru -->
    <a href="{{ route('customer.reservasi.create') }}"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buat
        Reservasi Baru</a>

    <!-- Dropdown untuk Bayar -->
    <div class="mb-3 mt-4">
        <form action="{{ route('customer.reservasi.bayar') }}" method="GET">
            <select name="id_reservasi" id="bayar_reservasi"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                onchange="this.form.submit()">
                <option value="" disabled selected>Pilih Reservasi untuk Dibayar</option>
                @foreach ($reservasi as $item)
                    @if ($item->status_pembayaran !== 'Lunas')
                        <option value="{{ $item->id_reservasi }}">
                            {{ $item->kucing->nama }} ({{ $item->tanggal_reservasi }} - {{ $item->tanggal_selesai }})
                        </option>
                    @endif
                @endforeach
            </select>
        </form>
    </div>

    <!-- Tabel Reservasi -->
    <table
        class="text-gray-500 text-sm rounded-lg focus:ring-blue-500 dark:bg-transparent dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 w-full p-2.5 mt-3">
        <thead>
            <tr>
                <th
                    class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                    No</th>
                <th
                    class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                    Nama Kucing</th>
                <th
                    class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                    Kandang</th>
                <th
                    class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                    Tanggal Mulai</th>
                <th
                    class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                    Tanggal Selesai</th>
                <th
                    class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                    Status</th>
                <th
                    class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                    Status Pembayaran</th>
                <th
                    class="py-4 px-4 border-b dark:border-gray-500 border-gray-400 dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-700">
                    Action</th>
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
                        {{ $item->kucing->nama }}</td>
                    <td
                        class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                        {{ $item->kandang->ukuran }}</td>
                    <td
                        class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                        {{ $item->tanggal_reservasi }}</td>
                    <td
                        class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                        {{ $item->tanggal_selesai }}</td>
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
                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                            {{ $item->status_pembayaran }}
                        </span>
                    </td>
                    <td
                        class="py-6 px-4 mb-2 text-center border-b dark:border-gray-600 border-gray-300 bg-transparent dark:text-gray-400 text-gray-700">
                        <a href="{{ route('customer.reservasi.edit', $item->id_reservasi) }}"
                            class="btn btn-warning btn-sm"><svg class="w-6 h-6 inline align-middle" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m14.3 4.8 2.9 2.9M7 7H4a1 1 0 0 0-1 1v10c0 .6.4 1 1 1h11c.6 0 1-.4 1-1v-4.5m2.4-10a2 2 0 0 1 0 3l-6.8 6.8L8 14l.7-3.6 6.9-6.8a2 2 0 0 1 2.8 0Z" />
                            </svg></a>
                        <form action="{{ route('customer.reservasi.destroy', $item->id_reservasi) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')"><svg class="w-6 h-6 inline align-middle"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                </svg></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
