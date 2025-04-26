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
        <h1 class="text-xl font-bold text-gray-700 mb-4">Form Pemeriksaan ANC</h1>

        <div class="bg-white shadow rounded-lg p-6 space-y-6">
            <div class="text-sm text-gray-600">
                <p><strong>Nama:</strong> {{ $service->patient->full_name }}</p>
                <p><strong>Jenis Layanan:</strong> ANC</p>
                <p><strong>Antrean:</strong> #{{ str_pad($service->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
            </div>

            <form action="{{ route('bidan.periksa.anc.simpan', $service->id) }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="hpht" class="block text-gray-700 text-sm font-bold mb-2">HPHT</label>
                        <input type="date" id="hpht" name="hpht" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                    <div>
                        <label for="tekanan_darah" class="block text-gray-700 text-sm font-bold mb-2">Tekanan Darah</label>
                        <input type="text" id="tekanan_darah" name="tekanan_darah"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                    <div>
                        <label for="tinggi_fundus" class="block text-gray-700 text-sm font-bold mb-2">Tinggi Fundus
                            (cm)</label>
                        <input type="text" id="tinggi_fundus" name="tinggi_fundus"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                    <div>
                        <label for="tinggi_badan" class="block text-gray-700 text-sm font-bold mb-2">Tinggi Badan
                            (cm)</label>
                        <input type="text" id="tinggi_badan" name="tinggi_badan"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                    <div>
                        <label for="denyut_janin" class="block text-gray-700 text-sm font-bold mb-2">Denyut Jantung
                            Janin</label>
                        <input type="text" id="denyut_janin" name="denyut_janin"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                    <div>
                        <label for="berat_badan" class="block text-gray-700 text-sm font-bold mb-2">Berat Badan (kg)</label>
                        <input type="text" id="berat_badan" name="berat_badan"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                    <div>
                        <label for="lingkar_lengan_atas" class="block text-gray-700 text-sm font-bold mb-2">Lingkar Lengan
                            Atas (LILA)</label>
                        <input type="text" id="lingkar_lengan_atas" name="lingkar_lengan_atas"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">BMI (Body Mass Index)</label>
                        <input type="text" name="bmi" id="bmi" class="form-input w-full bg-gray-100"
                            readonly />
                        <p class="text-sm mt-1 text-pink-500" id="bmi_kategori"></p>
                    </div>

                </div>

                <div class="mt-4">
                    <label class="block font-medium mb-1">Keluhan Saat Ini</label>
                    <textarea name="keluhan_saat_ini" class="form-textarea w-full" rows="3"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="riwayat_kehamilan" class="block text-gray-700 text-sm font-bold mb-2">Riwayat
                            Kehamilan</label>
                        <input type="text" id="riwayat_kehamilan" name="riwayat_kehamilan"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                    <div>
                        <label for="riwayat_persalinan" class="block text-gray-700 text-sm font-bold mb-2">Riwayat
                            Persalinan</label>
                        <input type="text" id="riwayat_persalinan" name="riwayat_persalinan"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                    <div>
                        <label for="riwayat_abortus" class="block text-gray-700 text-sm font-bold mb-2">Riwayat
                            Abortus</label>
                        <input type="text" id="riwayat_abortus" name="riwayat_abortus"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                    <div>
                        <label for="riwayat_penyakit_keluarga" class="block text-gray-700 text-sm font-bold mb-2">Riwayat
                            Penyakit Keluarga</label>
                        <input type="text" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-medium mb-1">Catatan Tambahan</label>
                    <textarea name="catatan" class="form-textarea w-full" rows="3"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                        Simpan Pemeriksaan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function hitungBMI() {
            const berat = parseFloat(document.querySelector('input[name="berat_badan"]').value);
            const tinggi = parseFloat(document.querySelector('input[name="tinggi_badan"]').value);
            const bmiField = document.getElementById('bmi');
            const kategoriField = document.getElementById('bmi_kategori');

            if (berat && tinggi) {
                const tinggiMeter = tinggi / 100;
                const bmi = berat / (tinggiMeter * tinggiMeter);
                bmiField.value = bmi.toFixed(2);

                // Kategori BMI
                let kategori = '';
                if (bmi < 18.5) kategori = 'Kurus';
                else if (bmi < 24.9) kategori = 'Normal';
                else if (bmi < 29.9) kategori = 'Gemuk';
                else kategori = 'Obesitas';

                kategoriField.innerText = `Kategori: ${kategori}`;
            } else {
                bmiField.value = '';
                kategoriField.innerText = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('input[name="berat_badan"]').addEventListener('input', hitungBMI);
            document.querySelector('input[name="tinggi_badan"]').addEventListener('input', hitungBMI);
        });
    </script>
@endsection
