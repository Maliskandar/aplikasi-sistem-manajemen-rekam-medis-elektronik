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
    <div class="max-w-xl mx-auto py-10">
        <h1 class="text-xl font-bold text-gray-700 mb-6">Resep Obat / Vitamin</h1>

        <div class="bg-white shadow rounded-lg p-6 space-y-6">
            <div>
                <p class="text-sm text-gray-600">Pasien: <strong>{{ $service->patient->full_name }}</strong></p>
                <p class="text-sm text-gray-600">Layanan: <strong>{{ $service->service_type }}</strong></p>
            </div>

            <form action="{{ route('bidan.obat.simpan', $service->id) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block font-medium">Nama Obat / Vitamin</label>
                        <input type="text" name="nama_obat" class="form-input w-full" required>
                    </div>

                    <div>
                        <label class="block font-medium">Dosis</label>
                        <input type="text" name="dosis" class="form-input w-full">
                    </div>

                    <div>
                        <label class="block font-medium">Aturan Pakai</label>
                        <input type="text" name="aturan_pakai" class="form-input w-full">
                    </div>

                    <div>
                        <label class="block font-medium">Catatan Tambahan</label>
                        <textarea name="catatan" class="form-textarea w-full" rows="3"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Simpan Resep
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
