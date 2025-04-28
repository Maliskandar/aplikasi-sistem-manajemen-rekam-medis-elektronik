@extends('asisten.components.layout')

@section('content')
    <div class="max-w-6xl mx-auto py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Daftar Pasien</h1>
            <a href="{{ route('asisten.patients.create') }}"
                class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-lg font-semibold">
                + Tambah Pasien
            </a>
        </div>

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

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-left border border-gray-200">
                <thead class="bg-gray-100 font-bold">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">NIK</th>
                        <th class="px-4 py-2">Nomor HP</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $patient->full_name }}</td>
                            <td class="px-4 py-2">{{ $patient->nik }}</td>
                            <td class="px-4 py-2">{{ $patient->phone }}</td>
                            <td class="px-4 py-2 flex justify-center gap-2">
                                <a href="{{ route('asisten.patients.edit', $patient->id) }}"
                                    class="text-blue-600 hover:underline">Edit</a>

                                <form action="{{ route('asisten.patients.destroy', $patient->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($patients->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data pasien.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showServiceModal(patientId, patientName) {
            Swal.fire({
                title: 'Daftar Pelayanan',
                html: `
                <form id="serviceForm" action="/asisten/patient/${patientId}/register-service" method="POST">
                    @csrf
                    <label class="block mb-2 text-sm text-left text-gray-700">Pilih Jenis Pelayanan:</label>
                    <select name="service_type" class="swal2-input" required>
                        <option value="">-- Pilih --</option>
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
                confirmButtonText: 'Daftar',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    document.getElementById('serviceForm').submit();
                }
            });
        }
    </script>
@endsection
