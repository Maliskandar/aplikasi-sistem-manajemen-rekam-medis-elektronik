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

        // ➡ Update status otomatis jadi "Sedang Diperiksa"
        if ($service->status === 'Siap Diperiksa') {
            $service->update([
                'status' => 'Sedang Diperiksa',
            ]);
        }

        // ➡ Lanjutkan ke form pemeriksaan sesuai jenis layanan
        switch ($service->service_type) {
            case 'ANC':
                return view('bidan.forms.anc', compact('service'));
            case 'PNC':
                return view('bidan.forms.pnc', compact('service'));
            case 'KB & Kes Pro':
                return view('bidan.forms.kbKesPro', compact('service')); // perbaiki nama file nya (ga boleh ada &)
            case 'BBL':
                return view('bidan.forms.bbl', compact('service'));
            case 'Umum':
                return view('bidan.forms.umum', compact('service'));
            default:
                abort(404, 'Form belum tersedia.');
        }
    }


    // public function mulaiPeriksa($id)
    // {
    //     $service = \App\Models\PatientService::findOrFail($id);

    //     if ($service->status === 'Siap Diperiksa') {
    //         $service->update([
    //             'status' => 'Sedang Diperiksa',
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Pasien sedang dalam pemeriksaan.');
    // }


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

        // $service->update(['status' => 'Diperiksa']);

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
            'nama_obat' => 'required|array',
            'nama_obat.*' => 'required|string',
            'dosis' => 'nullable|array',
            'aturan_pakai' => 'nullable|array',
            'catatan' => 'nullable|array',
        ]);

        $service = PatientService::with('patient')->findOrFail($id);

        foreach ($request->nama_obat as $index => $namaObat) {
            Prescription::create([
                'patient_service_id' => $service->id,
                'nama_obat' => $namaObat,
                'dosis' => $request->dosis[$index] ?? null,
                'aturan_pakai' => $request->aturan_pakai[$index] ?? null,
                'catatan' => $request->catatan[$index] ?? null,
            ]);
        }

        $service->update(['status' => 'Selesai Pemeriksaan']);

        Inbox::create([
            'title' => 'Resep Obat untuk ' . $service->patient->full_name,
            'message' => 'Bidan telah meresepkan obat untuk pasien ' . $service->patient->full_name . ' pada layanan ' . $service->service_type . '.',
            'patient_service_id' => $service->id,
        ]);

        return redirect()->route('bidan.antrean')->with('success', 'Semua resep berhasil disimpan dan pasien selesai diperiksa.');
    }



}