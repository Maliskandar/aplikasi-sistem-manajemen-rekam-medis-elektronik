@extends('asisten.components.layout')

@section('content')
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">Edit Data Pasien</h1>

        <form action="{{ route('asisten.patients.update', $patient->id) }}" method="POST"
            class="bg-white shadow rounded-lg p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nik" class="block font-medium">NIK*</label>
                    <input type="text" id="nik" name="nik" class="form-input w-full" value="{{ $patient->nik }}"
                        required>
                </div>

                <div>
                    <label for="full_name" class="block font-medium">Nama Lengkap*</label>
                    <input type="text" id="full_name" name="full_name" class="form-input w-full"
                        value="{{ $patient->full_name }}" required>
                </div>

                <div>
                    <label for="birth_date" class="block font-medium">Tanggal Lahir*</label>
                    <input type="date" id="birth_date" name="birth_date" class="form-input w-full"
                        value="{{ $patient->birth_date->format('Y-m-d') }}" required>
                </div>

                <div>
                    <label for="phone" class="block font-medium">Nomor HP*</label>
                    <input type="text" id="phone" name="phone" class="form-input w-full"
                        value="{{ $patient->phone }}" required>
                </div>

                <div>
                    <label for="gender" class="block font-medium">Jenis Kelamin*</label>
                    <select id="gender" name="gender" class="form-select w-full" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ $patient->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $patient->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label for="marital_status" class="block font-medium">Status Pernikahan*</label>
                    <select id="marital_status" name="marital_status" class="form-select w-full" required>
                        <option value="">-- Pilih --</option>
                        @foreach (['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                            <option value="{{ $status }}" {{ $patient->marital_status == $status ? 'selected' : '' }}>
                                {{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="address" class="block font-medium">Alamat*</label>
                <textarea name="address" rows="3" class="form-textarea w-full" required>{{ $patient->address }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="province" class="form-input w-full" value="{{ $patient->province }}"
                    placeholder="Provinsi*" required>
                <input type="text" name="city" class="form-input w-full" value="{{ $patient->city }}"
                    placeholder="Kota/Kabupaten*" required>
                <input type="text" name="district" class="form-input w-full" value="{{ $patient->district }}"
                    placeholder="Kecamatan*" required>
                <input type="text" name="sub_district" class="form-input w-full" value="{{ $patient->sub_district }}"
                    placeholder="Kelurahan*" required>
                <input type="text" name="postal_code" class="form-input w-full" value="{{ $patient->postal_code }}"
                    placeholder="Kode Pos*" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="insurance" class="block font-medium">Asuransi*</label>
                    <select name="insurance" class="form-select w-full" required>
                        @foreach (['Tidak Ada', 'BPJS', 'Asuransi Lainnya'] as $option)
                            <option value="{{ $option }}" {{ $patient->insurance == $option ? 'selected' : '' }}>
                                {{ $option }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="payment_type" class="block font-medium">Jenis Pembayaran*</label>
                    <select name="payment_type" class="form-select w-full" required>
                        @foreach (['Mandiri', 'BPJS', 'Asuransi Lainnya'] as $option)
                            <option value="{{ $option }}" {{ $patient->payment_type == $option ? 'selected' : '' }}>
                                {{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-medium">Kontak Lain (JSON)</label>
                <input type="text" name="other_contacts[]" class="form-input w-full"
                    value="{{ is_array($patient->other_contacts) ? $patient->other_contacts[0] : '' }}">
            </div>

            <div class="pt-4">
                <button type="submit" class="px-6 py-2 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg">
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
@endsection
