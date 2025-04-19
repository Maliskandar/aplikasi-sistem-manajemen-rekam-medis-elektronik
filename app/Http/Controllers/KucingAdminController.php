<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kucing;
use App\Models\Customer;
use Illuminate\Http\Request;

class KucingAdminController extends Controller
{
    public function index()
    {
        $kucings = Kucing::with('customer')->get();
        return view('admin.kucings.index', compact('kucings'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('admin.kucings.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ras' => 'required|string|max:100',
            'info_kesehatan' => 'required|string|max:255',
            'id_pelanggan' => 'required|exists:customers,id_customer',
        ]);

        Kucing::create($request->all());
        return redirect()->route('admin.kucings.index')->with('success', 'Kucing berhasil ditambahkan.');
    }

    public function edit($id_kucing)
    {
        $kucing = Kucing::findOrFail($id_kucing);
        $customers = Customer::all();
        return view('admin.kucings.edit', compact('kucing', 'customers'));
    }

    public function update(Request $request, $id_kucing)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ras' => 'required|string|max:100',
            'info_kesehatan' => 'required|string|max:255',
            'id_pelanggan' => 'required|exists:customers,id_customer',
        ]);

        $kucing = Kucing::findOrFail($id_kucing);
        $kucing->update($request->all());
        return redirect()->route('admin.kucings.index')->with('success', 'Kucing berhasil diperbarui.');
    }

    public function destroy($id_kucing)
    {
        $kucing = Kucing::findOrFail($id_kucing);
        $kucing->delete();
        return redirect()->route('admin.kucings.index')->with('success', 'Kucing berhasil dihapus.');
    }
}