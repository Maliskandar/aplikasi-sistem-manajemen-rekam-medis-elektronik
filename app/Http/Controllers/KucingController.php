<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kucing;
use Illuminate\Support\Facades\Auth;

class KucingController extends Controller
{
    // Tampilkan daftar kucing milik customer
    public function index()
    {
        $kucing = Kucing::where('id_customer', Auth::user()->id)->get();
        return view('customer.kucing.index', compact('kucing'));
    }

    // Tampilkan form tambah kucing
    public function create()
    {
        return view('customer.kucing.create');
    }

    // Simpan data kucing baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ras' => 'required|string|max:255',
            'info_kesehatan' => 'required|string',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil customer terkait user
        $customer = $user->customer;

        if (!$customer) {
            return redirect()->back()->with('error', 'Data customer tidak ditemukan untuk user ini.');
        }

        // Simpan data kucing
        Kucing::create([
            'nama' => $request->nama,
            'ras' => $request->ras,
            'info_kesehatan' => $request->info_kesehatan,
            'id_customer' => $customer->id_customer, // Ambil ID dari tabel customer
        ]);

        return redirect()->route('customer.kucing.index')->with('message', 'Data kucing berhasil ditambahkan!');
    }

    // Tampilkan form edit kucing
    public function edit($id)
    {
        $kucing = Kucing::where('id_customer', Auth::user()->id)->findOrFail($id);
        return view('customer.kucing.edit', compact('kucing'));
    }

    // Update data kucing
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ras' => 'required|string|max:255',
            'info_kesehatan' => 'required|string',
        ]);

        $kucing = Kucing::where('id_customer', Auth::user()->id)->findOrFail($id);
        $kucing->update($request->all());

        return redirect()->route('customer.kucing.index')->with('message', 'Data kucing berhasil diperbarui!');
    }

    // Hapus data kucing
    public function destroy($id)
    {
        $kucing = Kucing::where('id_customer', Auth::user()->id)->findOrFail($id);
        $kucing->delete();

        return redirect()->route('customer.kucing.index')->with('message', 'Data kucing berhasil dihapus!');
    }
}