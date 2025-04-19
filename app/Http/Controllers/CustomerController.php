<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'info_kontak' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:6',
        ]);

        Customer::create($request->all());
        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil ditambahkan.');
    }

    public function edit($id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id_customer)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'info_kontak' => 'required|string|max:255',
            'email' => 'required|email|unique:id_customer,email,' . $id_customer,
        ]);

        $customer = Customer::findOrFail($id_customer);
        $customer->update($request->all());
        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil diperbarui.');
    }

    public function destroy($id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil dihapus.');
    }
}