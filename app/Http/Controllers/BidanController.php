<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientService;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use App\Models\AncRecord;
use App\Models\Prescription;
use App\Models\Inbox;


class BidanController extends Controller
{

    public function antreanBidan()
    {
        $today = Carbon::today();

        $services = PatientService::with('patient')
            ->whereDate('queue_date', $today)
            ->where('status', 'Siap Diperiksa')
            ->orderBy('queue_number')
            ->get();

        return view('bidan.patients.antrean', compact('services'));
    }

    public function periksa($id)
    {
        $service = PatientService::with('patient')->findOrFail($id);

        switch ($service->service_type) {
            case 'ANC':
                return view('bidan.forms.anc', compact('service'));
            case 'PNC':
                return view('bidan.forms.pnc', compact('service'));
            case 'KB & Kes Pro':
                return view('bidan.forms.kb&KesPro', compact('service'));
            case 'BBL':
                return view('bidan.forms.bbl', compact('service'));
            case 'Umum':
                return view('bidan.forms.umum', compact('service'));
            default:
                abort(404, 'Form belum tersedia.');
        }
    }

    public function simpanAnc(Request $request, $id)
    {
        $request->validate([
            'hpht' => 'required|date',
            'bmi' => 'nullable|string',
            'keluhan_saat_ini' => 'nullable|string',
            'riwayat_kehamilan' => 'nullable|string',
            'riwayat_persalinan' => 'nullable|string',
            'riwayat_abortus' => 'nullable|string',
            'riwayat_penyakit_keluarga' => 'nullable|string',
            'tekanan_darah' => 'nullable|string',
            'tinggi_fundus' => 'nullable|string',
            'denyut_janin' => 'nullable|string',
            'lingkar_lengan_atas' => 'nullable|string',
            'berat_badan' => 'nullable|string',
            'tinggi_badan' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $service = PatientService::findOrFail($id);

        AncRecord::create(array_merge($request->all(), [
            'patient_service_id' => $service->id
        ]));

        $service->update(['status' => 'Diperiksa']);

        return redirect()->route('bidan.obat.form', $service->id)
            ->with('success', 'Pemeriksaan ANC disimpan. Silakan berikan resep.');

    }

    public function formObat($id)
    {
        $service = PatientService::with('patient')->findOrFail($id);
        return view('bidan.forms.obat', compact('service'));
    }

    public function simpanObat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'dosis' => 'nullable|string',
            'aturan_pakai' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        // Ambil data layanan beserta data pasien
        $service = PatientService::with('patient')->findOrFail($id);

        // Simpan data resep
        $prescription = Prescription::create([
            'patient_service_id' => $service->id,
            'nama_obat' => $request->nama_obat,
            'dosis' => $request->dosis,
            'aturan_pakai' => $request->aturan_pakai,
            'catatan' => $request->catatan,
        ]);

        // Perbarui status pasien jika resep berhasil dibuat
        if ($prescription) {
            $service->update(['status' => 'Selesai']);

            // Kirim notifikasi ke inbox asisten
            Inbox::create([
                'title' => 'Resep Obat untuk ' . $service->patient->full_name,
                'message' => 'Bidan telah meresepkan obat untuk pasien ' . $service->patient->full_name . ' pada layanan ' . $service->service_type . '.',
                'patient_service_id' => $service->id,
            ]);
        }

        return redirect()->route('bidan.antrean')
            ->with('success', 'Obat berhasil diresepkan dan pasien selesai diperiksa.');
    }


}