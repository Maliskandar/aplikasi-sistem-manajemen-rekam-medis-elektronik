<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\Kucing;
use Illuminate\Support\Facades\Storage;

class TrackingController extends Controller
{
    // Menampilkan data tracking untuk Admin
    public function index()
    {
        $tracking = Tracking::with('kucing')->orderBy('created_at', 'desc')->get();
        return view('admin.tracking.index', compact('tracking'));
    }

    // Form Tambah Laporan Tracking
    public function create()
    {
        $kucing = Kucing::all();
        return view('admin.tracking.create', compact('kucing'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'id_kucing' => 'required|exists:kucing,id_kucing',
            'laporan' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Simpan ke dalam folder public/img
            $fotoPath = $request->file('foto')->move(public_path('public/img'), $request->file('foto')->getClientOriginalName());
            $fotoPath = 'public/img/' . $request->file('foto')->getClientOriginalName(); // Relatif untuk disimpan ke DB
        }

        Tracking::create([
            'id_kucing' => $request->id_kucing,
            'laporan' => $request->laporan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.tracking.index')->with('success', 'Laporan tracking berhasil ditambahkan.');
    }

    // Form Edit Laporan Tracking
    public function edit($id)
    {
        $tracking = Tracking::findOrFail($id);
        $kucing = Kucing::all();
        return view('admin.tracking.edit', compact('tracking', 'kucing'));
    }

    // Update data laporan
    public function update(Request $request, $id)
    {
        $tracking = Tracking::findOrFail($id);

        $request->validate([
            'id_kucing' => 'required|exists:kucing,id_kucing',
            'laporan' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Hapus foto lama jika ada upload baru
        if ($request->hasFile('foto')) {
            if ($tracking->foto && file_exists(public_path($tracking->foto))) {
                unlink(public_path($tracking->foto)); // Hapus file lama
            }

            // Simpan ke dalam folder public/img
            $fotoPath = $request->file('foto')->move(public_path('public/img'), $request->file('foto')->getClientOriginalName());
            $tracking->foto = 'public/img/' . $request->file('foto')->getClientOriginalName(); // Relatif untuk disimpan ke DB
        }

        $tracking->update([
            'id_kucing' => $request->id_kucing,
            'laporan' => $request->laporan,
            'foto' => $tracking->foto,
        ]);

        return redirect()->route('admin.tracking.index')->with('success', 'Laporan tracking berhasil diperbarui.');
    }

    // Hapus laporan tracking
    public function destroy($id)
    {
        $tracking = Tracking::findOrFail($id);

        if ($tracking->foto && file_exists(public_path($tracking->foto))) {
            unlink(public_path($tracking->foto)); // Hapus file gambar
        }

        $tracking->delete();

        return redirect()->route('admin.tracking.index')->with('success', 'Laporan tracking berhasil dihapus.');
    }

    // Menampilkan laporan untuk Customer
    public function showCustomerTracking()
    {
        $tracking = Tracking::with('kucing')->whereHas('kucing', function ($query) {
            $query->where('id_customer', auth()->id()); // Pastikan kucing milik user login
        })->orderBy('created_at', 'desc')->get();

        return view('customer.tracking.index', compact('tracking'));
    }
}