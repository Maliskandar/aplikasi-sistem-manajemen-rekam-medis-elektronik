@extends('asisten.components.layout')

@section('content')
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">Tambah Pasien Baru</h1>

        <form action="{{ route('asisten.patients.store') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nik" class="block font-medium">NIK*</label>
                    <input type="text" id="nik" name="nik" class="form-input w-full" required>
                </div>

                <div>
                    <label for="full_name" class="block font-medium">Nama Lengkap*</label>
                    <input type="text" id="full_name" name="full_name" class="form-input w-full" required>
                </div>

                <div>
                    <label for="birth_date" class="block font-medium">Tanggal Lahir*</label>
                    <input type="date" id="birth_date" name="birth_date" class="form-input w-full" required>
                </div>

                <div>
                    <label for="phone" class="block font-medium">Nomor HP*</label>
                    <input type="text" id="phone" name="phone" class="form-input w-full" required>
                </div>

                <div>
                    <label class="block font-medium">Jenis Kelamin*</label>
                    <select name="gender" class="form-select w-full" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block font-medium">Status Pernikahan*</label>
                    <select name="marital_status" class="form-select w-full" required>
                        <option value="">-- Pilih --</option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="address" class="block font-medium">Alamat*</label>
                <textarea name="address" rows="3" class="form-textarea w-full" required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input class="form-input w-full" type="text" name="province" placeholder="Provinsi*" required>
                <input class="form-input w-full" type="text" name="city" placeholder="Kota/Kabupaten*" required>
                <input class="form-input w-full" type="text" name="district" placeholder="Kecamatan*" required>
                <input class="form-input w-full" type="text" name="sub_district" placeholder="Kelurahan*" required>
                <input class="form-input w-full" type="text" name="postal_code" placeholder="Kode Pos*" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Asuransi*</label>
                    <select name="insurance" class="form-select w-full" required>
                        <option value="">-- Pilih --</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                        <option value="BPJS">BPJS</option>
                        <option value="Asuransi Lainnya">Asuransi Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block font-medium">Jenis Pembayaran*</label>
                    <select name="payment_type" class="form-select w-full" required>
                        <option value="">-- Pilih --</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BPJS">BPJS</option>
                        <option value="Asuransi Lainnya">Asuransi Lainnya</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-medium">Kontak Lain (Opsional)</label>
                <input type="text" name="other_contacts[]" class="form-input w-full mb-2"
                    placeholder="Contoh: 08123456789">
                <input type="text" name="other_contacts[]" class="form-input w-full" placeholder="Tambahan lainnya...">
            </div>

            <div class="pt-4">
                <button type="submit" class="px-6 py-2 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg">
                    Simpan Data Pasien
                </button>
            </div>
        </form>
    </div>
@endsection
