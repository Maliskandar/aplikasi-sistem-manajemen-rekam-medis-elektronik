<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandang;

class KandangController extends Controller
{
    public function index()
    {
        $kandang = Kandang::all();
        return view('admin.kandang.index', compact('kandang'));
    }

    public function create()
    {
        return view('admin.kandang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ukuran' => 'required|string',
            'ketersediaan' => 'required|boolean',
        ]);

        Kandang::create($request->all());
        return redirect()->route('admin.kandang.index')->with('success', 'Kandang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kandang = Kandang::findOrFail($id);
        return view('admin.kandang.edit', compact('kandang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ukuran' => 'required|string',
            'ketersediaan' => 'required|boolean',
        ]);

        $kandang = Kandang::findOrFail($id);
        $kandang->update($request->all());

        return redirect()->route('admin.kandang.index')->with('success', 'Kandang berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kandang = Kandang::findOrFail($id);
        $kandang->delete();

        return redirect()->route('admin.kandang.index')->with('success', 'Kandang berhasil dihapus.');
    }
}