<?php

namespace Bystrov\AbstractShop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Bystrov\AbstractShop\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        return view('abstract-shop::suppliers.index', [
            'items' => Supplier::query()->orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('abstract-shop::suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
        ]);
        Supplier::query()->create($data);
        return redirect()->route('abstract-shop.suppliers.index');
    }

    public function show(Supplier $supplier)
    {
        return view('abstract-shop::suppliers.show', ['item' => $supplier]);
    }

    public function edit(Supplier $supplier)
    {
        return view('abstract-shop::suppliers.edit', ['item' => $supplier]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
        ]);
        $supplier->update($data);
        return redirect()->route('abstract-shop.suppliers.index');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('abstract-shop.suppliers.index');
    }
}

