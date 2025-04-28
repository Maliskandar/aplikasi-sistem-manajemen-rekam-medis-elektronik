@extends('asisten.components.layout')

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
        <h1 class="text-2xl font-bold text-gray-700 mb-6">Riwayat Pelayanan Kebidanan</h1>

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-left border border-gray-200">
                <thead class="bg-gray-100 font-bold">
                    <tr>
                        <th class="px-4 py-2">Nama Pasien</th>
                        <th class="px-4 py-2">NIK</th>
                        <th class="px-4 py-2">Jenis Layanan</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $service->patient->full_name }}</td>
                            <td class="px-4 py-2">{{ $service->patient->nik }}</td>
                            <td class="px-4 py-2">{{ $service->service_type }}</td>
                            <td class="px-4 py-2">{{ $service->created_at->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">
                                <span
                                    class="text-sm font-semibold
                                    @if ($service->status == 'Selesai Kunjungan') bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300 
                                    @elseif($service->status == 'Selesai Pemeriksaan') bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-pink-900 dark:text-pink-300
                                    @elseif($service->status == 'Sedang Diperiksa') bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300 
                                    @elseif($service->status == 'Siap Diperiksa') bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300 
                                    @elseif($service->status == 'Menunggu') bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300 
                                    @else text-gray-600 @endif">
                                    {{ $service->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('asisten.riwayat.detail', $service->id) }}"
                                    class="text-blue-600 hover:underline">
                                    Detail
                                </a>
                                @if ($service->status == 'Selesai')
                                    <a href="{{ route('asisten.riwayat.cetak', $service->id) }}" target="_blank"
                                        class="text-pink-600 hover:underline">
                                        Cetak PDF
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">
                                Tidak ada data riwayat pelayanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
