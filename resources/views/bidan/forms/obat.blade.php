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
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6 text-gray-700">Input Resep Obat</h1>

        <form action="{{ route('bidan.obat.simpan', $service->id) }}" method="POST">
            @csrf

            <div id="obat-wrapper" class="space-y-6">
                <div class="obat-item bg-white p-6 rounded-lg shadow space-y-4">
                    <input type="text" name="nama_obat[]" placeholder="Nama Obat" class="form-input w-full" required>
                    <input type="text" name="dosis[]" placeholder="Dosis" class="form-input w-full">
                    <input type="text" name="aturan_pakai[]" placeholder="Aturan Pakai" class="form-input w-full">
                    <textarea name="catatan[]" placeholder="Catatan" class="form-textarea w-full"></textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="button" id="tambah-obat"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    + Tambah Obat
                </button>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-6 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-lg font-semibold">
                    Simpan Semua Resep
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('tambah-obat').addEventListener('click', function() {
            const wrapper = document.getElementById('obat-wrapper');
            const item = wrapper.querySelector('.obat-item');
            const clone = item.cloneNode(true);
            // Reset input value
            clone.querySelectorAll('input, textarea').forEach(input => input.value = '');
            wrapper.appendChild(clone);
        });
    </script>
@endsection
