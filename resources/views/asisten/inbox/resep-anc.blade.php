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
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-4 text-gray-700">
            Resep Obat - {{ $anc->patientService->patient->full_name }}
        </h1>

        <div class="bg-white shadow p-6 rounded-lg space-y-4">
            @forelse ($resep as $item)
                <div class="border-b pb-2">
                    <p><strong>Obat:</strong> {{ $item->nama_obat }}</p>
                    <p><strong>Dosis:</strong> {{ $item->dosis }}</p>
                    <p><strong>Aturan Pakai:</strong> {{ $item->aturan_pakai }}</p>
                    <p><strong>Catatan:</strong> {{ $item->catatan }}</p>
                </div>
            @empty
                <p class="text-gray-500">Tidak ada resep ditemukan.</p>
            @endforelse
        </div>
    </div>
@endsection
