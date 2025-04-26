@extends('bidan.components.layout')

@section('content')
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: 'Success!',
                    text: @json(session('success')),
                    icon: 'success',
                    confirmButtonColor: '#1f2937',
                    background: '#111827',
                    color: '#ffffff'
                });
            });
        </script>
    @endif
    <div class="max-w-6xl mx-auto py-10">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">Antrean Pasien Siap Diperiksa</h1>

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-left border border-gray-200">
                <thead class="bg-gray-100 font-bold">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">NIK</th>
                        <th class="px-4 py-2">Jenis Layanan</th>
                        <th class="px-4 py-2">Antrean</th>
                        <th class="px-4 py-2">Waktu Daftar</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $service->patient->full_name }}</td>
                            <td class="px-4 py-2">{{ $service->patient->nik }}</td>
                            <td class="px-4 py-2">{{ $service->service_type }}</td>
                            <td class="px-4 py-2">#{{ str_pad($service->queue_number, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-4 py-2">{{ $service->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-2">
                                @php
                                    $statusColor = match ($service->status) {
                                        'Menunggu'
                                            => 'bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300',
                                        'Siap Diperiksa'
                                            => 'bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300',
                                        'Diperiksa'
                                            => 'bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300',
                                        'Selesai'
                                            => 'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300',
                                        default
                                            => 'bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300',
                                    };
                                @endphp
                                <span class="text-sm font-medium {{ $statusColor }}">{{ $service->status }}</span>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('bidan.periksa', $service->id) }}"
                                    class="text-white bg-green-600 hover:bg-green-700 px-4 py-1 rounded-lg font-semibold text-sm">
                                    Periksa Sekarang
                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Belum ada pasien antre hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
