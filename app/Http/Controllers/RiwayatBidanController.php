<?php

namespace App\Http\Controllers;

use App\Models\PatientService;
use Illuminate\Routing\Controller;
use App\Models\AncRecord;
use App\Models\Prescription;
use Barryvdh\DomPDF\Facade\Pdf; // <- Pastikan pakai library DOMPDF!


class RiwayatBidanController extends Controller
{
    public function kebidanan()
    {
        $services = PatientService::whereIn('service_type', ['ANC', 'INC', 'PNC', 'KB dan Kes Pro'])
            ->with('patient')->latest()->get();

        return view('bidan.riwayat.kebidanan', compact('services'));
    }

    public function bayi()
    {
        $services = PatientService::where('service_type', 'BBL')
            ->with('patient')->latest()->get();

        return view('bidan.riwayat.bayi', compact('services'));
    }

    public function umum()
    {
        $services = PatientService::where('service_type', 'Umum')
            ->with('patient')->latest()->get();

        return view('bidan.riwayat.umum', compact('services'));
    }

    public function semua()
    {
        $services = PatientService::with('patient')->latest()->get();

        return view('bidan.riwayat.semua', compact('services'));
    }

    public function detail($id)
    {
        $service = PatientService::with('patient')->findOrFail($id);

        // Cek kalau layanan ANC, ambil record ANC nya
        $anc = null;
        if ($service->service_type == 'ANC') {
            $anc = AncRecord::where('patient_service_id', $service->id)->first();
        }

        // Ambil resep jika ada
        $resep = Prescription::where('patient_service_id', $service->id)->get();

        return view('bidan.riwayat.detail', compact('service', 'anc', 'resep'));
    }


    public function cetak($id)
    {
        $service = PatientService::with('patient')->findOrFail($id);
        $anc = AncRecord::where('patient_service_id', $service->id)->first();
        $resep = Prescription::where('patient_service_id', $service->id)->get();

        $pdf = Pdf::loadView('bidan.riwayat.cetak-pdf', compact('service', 'anc', 'resep'));

        return $pdf->stream('rekam-medis-' . $service->patient->full_name . '.pdf');
    }
}