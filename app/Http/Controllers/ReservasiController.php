<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Kucing;
use App\Models\Kandang;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasi = Reservasi::with(['kandang', 'kucing']) // Load relasi kandang dan kucing
            ->where('id_customer', Auth::id())             // Filter berdasarkan id_customer yang login
            ->get();

        return view('customer.reservasi.index', compact('reservasi'));
    }


    public function create()
    {
        $kandang = Kandang::where('ketersediaan', true)->get();
        $kucing = Kucing::where('id_customer', Auth::user()->customer->id_customer)->get();
        return view('customer.reservasi.create', compact('kandang', 'kucing'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kucing' => 'required|exists:kucing,id_kucing',
            'id_kandang' => 'required|exists:kandang,id_kandang',
            'tanggal_reservasi' => 'required|date|before_or_equal:tanggal_selesai',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_reservasi',
        ]);

        Reservasi::create([
            'id_customer' => Auth::id(),
            'id_kucing' => $request->id_kucing,
            'id_kandang' => $request->id_kandang,
            'tanggal_reservasi' => $request->tanggal_reservasi,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'Pending',
            'status_pembayaran' => 'Belum Dibayar',
        ]);


        return redirect()->route('customer.reservasi.index')->with('success', 'Reservasi berhasil dibuat!');
    }

    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $kandang = Kandang::all(); // Fetch all available kandang
        return view('customer.reservasi.edit', compact('reservasi', 'kandang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kandang' => 'required|exists:kandang,id_kandang',
            'tanggal_reservasi' => 'required|date',
            'status' => 'required|string',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update([
            'id_kandang' => $request->id_kandang,
            'tanggal_reservasi' => $request->tanggal_reservasi,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('customer.reservasi.index')->with('success', 'Reservasi updated successfully.');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();

        return redirect()->route('customer.reservasi.index')->with('success', 'Reservasi deleted successfully.');
    }

    public function bayarForm(Request $request)
    {
        $reservasi = Reservasi::findOrFail($request->id_reservasi);

        return view('customer.reservasi.bayar', compact('reservasi'));
    }

    // Proses pembayaran oleh customer
    public function prosesBayar(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        // Validasi sederhana
        if ($reservasi->status_pembayaran === 'Lunas') {
            return redirect()->route('customer.reservasi.index')->with('error', 'Reservasi ini sudah dibayar.');
        }

        $reservasi->update([
            'status_pembayaran' => 'Lunas',
            'status' => 'Aktif',
            'tanggal_pembayaran' => now(),
        ]);

        return redirect()->route('customer.reservasi.index')->with('success', 'Pembayaran berhasil dilakukan.');
    }

    // Index reservasi untuk admin
    public function indexAdmin()
    {
        $reservasi = Reservasi::with(['kucing', 'kandang', 'customer'])->get();
        return view('admin.reservasi.index', compact('reservasi'));
    }

}