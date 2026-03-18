<?php

namespace Bystrov\AbstractShop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Bystrov\AbstractShop\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        return view('abstract-shop::customers.index', [
            'items' => Customer::query()->orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('abstract-shop::customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
        Customer::query()->create($data);
        return redirect()->route('abstract-shop.customers.index');
    }

    public function show(Customer $customer)
    {
        return view('abstract-shop::customers.show', ['item' => $customer]);
    }

    public function edit(Customer $customer)
    {
        return view('abstract-shop::customers.edit', ['item' => $customer]);
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
        $customer->update($data);
        return redirect()->route('abstract-shop.customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('abstract-shop.customers.index');
    }
}

