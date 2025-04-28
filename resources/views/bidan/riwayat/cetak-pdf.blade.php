<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rekam Medis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
        }

        .section {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <h1>Rekam Medis Pasien</h1>

    <div class="section">
        <strong>Nama:</strong> {{ $service->patient->full_name }}<br>
        <strong>NIK:</strong> {{ $service->patient->nik }}<br>
        <strong>Jenis Pelayanan:</strong> {{ $service->service_type }}<br>
        <strong>Tanggal:</strong> {{ $service->created_at->format('d-m-Y') }}
    </div>

    @if ($anc)
        <div class="section">
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
        </div>
    @endif

    @if ($resep->count())
        <div class="section">
            <h2 class="text-xl font-semibold">Resep Obat</h2><br>
            @foreach ($resep as $item)
                {{ $item->nama_obat }} - {{ $item->dosis }} ({{ $item->aturan_pakai }})<br>
            @endforeach
        </div>
    @endif

</body>

</html>
