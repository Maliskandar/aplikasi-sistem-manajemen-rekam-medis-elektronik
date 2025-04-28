@extends('bidan.components.layout')

@section('content')
    <div class="max-w-4xl mx-auto py-10 space-y-6">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Detail Pemeriksaan Pasien</h1>

        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h2 class="text-xl font-semibold">Identitas Pasien</h2>
            <p><strong>Nama:</strong> {{ $service->patient->full_name }}</p>
            <p><strong>NIK:</strong> {{ $service->patient->nik }}</p>
            <p><strong>Jenis Pelayanan:</strong> {{ $service->service_type }}</p>
            <p><strong>Tanggal Pemeriksaan:</strong> {{ $service->created_at->format('d-m-Y') }}</p>
        </div>

        @if ($anc)
            <div class="bg-white p-6 rounded-lg shadow space-y-4">
                <h2 class="text-xl font-semibold">Data Pemeriksaan Fisik</h2>
                <p><strong>Tekanan Darah:</strong> {{ $anc->tekanan_darah }}</p>
                <p><strong>Tinggi Fundus:</strong> {{ $anc->tinggi_fundus }}</p>
                <p><strong>Denyut Janin:</strong> {{ $anc->denyut_janin }}</p>
                <p><strong>Lignkar Lengan Atas:</strong> {{ $anc->lingkar_lengan_atas }}</p>
                <p><strong>Berat Badan:</strong> {{ $anc->berat_badan }}</p>
                <p><strong>Tinggi Badan:</strong> {{ $anc->tinggi_badan }}</p>
                <p><strong>Catatan:</strong> {{ $anc->catatan }}</p>
                <p><strong>BMI:</strong> {{ $anc->bmi }}</p>
                <h2 class="text-xl font-semibold">Data Pemeriksaan ANC</h2>
                <p><strong>HPHT:</strong> {{ $anc->hpht }}</p>
                <p><strong>Keluhan Saat Ini:</strong> {{ $anc->keluhan_saat_ini }}</p>
                <p><strong>Riwayat Kehamilan:</strong> {{ $anc->riwayat_kehamilan }}</p>
                <p><strong>Riwayat Persalinan:</strong> {{ $anc->riwayat_persalinan }}</p>
                <p><strong>Riwayat Abortus:</strong> {{ $anc->riwayat_abortus }}</p>
                <p><strong>Riwayat Penyakit Keluarga:</strong> {{ $anc->riwayat_penyakit_keluarga }}</p>
                <!-- Tambah data ANC lainnya di sini -->
            </div>
        @endif

        @if ($resep->count())
            <div class="bg-white p-6 rounded-lg shadow space-y-4">
                <h2 class="text-xl font-semibold">Resep Obat</h2>
                @foreach ($resep as $item)
                    <p><strong>Nama Obat:</strong> {{ $item->nama_obat }}</p>
                    <p><strong>Dosis:</strong> {{ $item->dosis }}</p>
                    <p><strong>Aturan Pakai:</strong> {{ $item->aturan_pakai }}</p>
                    <hr class="my-2">
                @endforeach
            </div>
        @endif

        <div class="flex justify-end">
            <a href="{{ route('bidan.riwayat.cetak', $service->id) }}" target="_blank"
                class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                Cetak Rekam Medis
            </a>
        </div>

    </div>
@endsection
