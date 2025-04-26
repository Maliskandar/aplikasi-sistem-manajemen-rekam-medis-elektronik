<?php

// app/Http/Controllers/PatientController.php
namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use App\Models\PatientService;


class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('services')->get(); // <- tambahkan eager loading
        return view('asisten.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('asisten.patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:patients,nik',
            'full_name' => 'required',
            'phone' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'marital_status' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'sub_district' => 'required',
            'postal_code' => 'required',
            'insurance' => 'required',
            'payment_type' => 'required',
            'other_contacts' => 'nullable|array',
        ]);

        Patient::create($validated);
        return redirect()->route('asisten.patients.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    public function show(Patient $patient)
    {
        return view('asisten.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('asisten.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:patients,nik,' . $patient->id,
            'full_name' => 'required',
            'phone' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'marital_status' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'sub_district' => 'required',
            'postal_code' => 'required',
            'insurance' => 'required',
            'payment_type' => 'required',
            'other_contacts' => 'nullable|array',
        ]);

        $patient->update($validated);
        return redirect()->route('asisten.patients.index')->with('success', 'Data pasien berhasil diperbarui');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('asisten.patients.index')->with('success', 'Data pasien berhasil dihapus');
    }

    // public function setReady($id)
    // {
    //     $patient = Patient::findOrFail($id);

    //     if ($patient->status !== 'Menunggu') {
    //         return back()->with('error', 'Pasien sudah diproses.');
    //     }

    //     $today = Carbon::now('Asia/Makassar')->format('Y-m-d'); // pastikan format date saja


    //     // Hitung antrean hari ini
    //     $queueToday = Patient::whereDate('queue_date', $today)
    //         ->where('status', 'Siap Diperiksa')
    //         ->count();

    //     $patient->update([
    //         'status' => 'Siap Diperiksa',
    //         'queue_number' => $queueToday + 1,
    //         'queue_date' => $today,
    //     ]);



    //     return back()->with('success', 'Pasien siap diperiksa dengan nomor antrean #' . str_pad($queueToday + 1, 3, '0', STR_PAD_LEFT));

    // }

    public function registerService(Request $request, $patientId)
    {
        $request->validate([
            'service_type' => 'required|in:ANC,INC,PNC,KB dan Kes Pro,Umum,BBL',
        ]);

        $today = \Carbon\Carbon::now('Asia/Makassar'); // bukan format 'Y-m-d'

        $queueToday = PatientService::whereDate('queue_date', $today)
            ->where('service_type', $request->service_type)
            ->count();

        $service = PatientService::create([
            'patient_id' => $patientId,
            'service_type' => $request->service_type,
            'queue_date' => $today,
            'queue_number' => $queueToday + 1,
            'status' => 'Siap Diperiksa',
        ]);

        return redirect()->route('asisten.kunjungan')->with('success', 'Pasien berhasil didaftarkan dengan antrean #' . str_pad($service->queue_number, 3, '0', STR_PAD_LEFT));
    }

    public function kunjunganHariIni()
    {
        $today = \Carbon\Carbon::today();
        $kunjungan = PatientService::with('patient')
            ->whereDate('queue_date', $today)
            ->orderBy('created_at')
            ->get();

        return view('asisten.patients.kunjungan', compact('kunjungan'));
    }


}