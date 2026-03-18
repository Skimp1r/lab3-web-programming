<?php

namespace Bystrov\AbstractShop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Bystrov\AbstractShop\Models\Warehouse;

class WarehouseController extends Controller
{
    public function index()
    {
        return view('abstract-shop::warehouses.index', [
            'items' => Warehouse::query()->orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('abstract-shop::warehouses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
        Warehouse::query()->create($data);
        return redirect()->route('abstract-shop.warehouses.index');
    }

    public function show(Warehouse $warehouse)
    {
        return view('abstract-shop::warehouses.show', ['item' => $warehouse]);
    }

    public function edit(Warehouse $warehouse)
    {
        return view('abstract-shop::warehouses.edit', ['item' => $warehouse]);
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
        $warehouse->update($data);
        return redirect()->route('abstract-shop.warehouses.index');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('abstract-shop.warehouses.index');
    }
}

