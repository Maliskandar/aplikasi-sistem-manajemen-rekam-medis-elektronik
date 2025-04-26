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
                        text: @json(session('success')), // Pastikan teks tetap aman
                        icon: 'success',
                        confirmButtonColor: '#1f2937', // Warna tombol dark mode
                        background: '#111827', // Background dark mode
                        color: '#ffffff' // Warna teks
                    });
                });
            </script>
        @endif
        <form method="POST" action="{{ route('asisten.patient.register-service', $patient->id) }}">
            @csrf
            <select name="service_type" class="form-select" required>
                <option value="">Pilih Jenis Pelayanan</option>
                <option value="ANC">ANC</option>
                <option value="INC">INC</option>
                <option value="PNC">PNC</option>
                <option value="KB dan Kes Pro">KB dan Kes Pro</option>
                <option value="Umum">Umum</option>
                <option value="BBL">BBL</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg mt-2">Daftar Layanan</button>
        </form>

    </div>
@endsection
