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
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Kunjungan Pasien Hari Ini</h1>
            <button onclick="openRegisterServiceModal()"
                class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-lg font-semibold">
                + Buat Kunjungan Baru
            </button>
        </div>

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-left border border-gray-200">
                <thead class="bg-gray-100 font-bold">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Pasien</th>
                        <th class="px-4 py-2">NIK</th>
                        <th class="px-4 py-2">Jenis Pelayanan</th>
                        <th class="px-4 py-2">Antrean</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Waktu Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kunjungan as $service)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $service->patient->full_name }}</td>
                            <td class="px-4 py-2">{{ $service->patient->nik }}</td>
                            <td class="px-4 py-2">{{ $service->service_type }}</td>
                            <td class="px-4 py-2">#{{ str_pad($service->queue_number, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-4 py-2">
                                @php
                                    $statusColor = match ($service->status) {
                                        'Menunggu'
                                            => 'bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300',
                                        'Siap Diperiksa'
                                            => 'bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300',
                                        'Sedang Diperiksa'
                                            => 'bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300',
                                        'Selesai Pemeriksaan'
                                            => 'bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-pink-900 dark:text-pink-300',
                                        'Selesai Kunjungan'
                                            => 'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300',
                                        default
                                            => 'bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300',
                                    };
                                @endphp
                                <span class="text-sm font-medium {{ $statusColor }}">{{ $service->status }}</span>
                            </td>
                            <td class="px-4 py-2">{{ $service->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Belum ada kunjungan hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openRegisterServiceModal() {
            Swal.fire({
                title: 'Cari Pasien',
                html: `
                <form id="registerServiceForm" action="{{ route('asisten.register.service') }}" method="POST">
                    @csrf
                    <label class="block mb-2 text-sm text-left text-gray-700">Nama Pasien:</label>
                    <input list="patientList" name="patient_id" class="swal2-input" required>
                    <datalist id="patientList">
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->full_name }} - {{ $patient->nik }}</option>
                        @endforeach
                    </datalist>

                    <label class="block mb-2 mt-4 text-sm text-left text-gray-700">Jenis Pelayanan:</label>
                    <select name="service_type" class="swal2-input" required>
                        <option value="">-- Pilih Layanan --</option>
                        <option value="ANC">ANC</option>
                        <option value="INC">INC</option>
                        <option value="PNC">PNC</option>
                        <option value="KB dan Kes Pro">KB dan Kes Pro</option>
                        <option value="Umum">Umum</option>
                        <option value="BBL">BBL</option>
                    </select>
                </form>
            `,
                showCancelButton: true,
                confirmButtonText: 'Daftarkan',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    document.getElementById('registerServiceForm').submit();
                }
            });
        }
    </script>
@endsection
