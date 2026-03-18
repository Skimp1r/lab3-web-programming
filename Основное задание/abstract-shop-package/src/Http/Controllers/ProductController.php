<?php

namespace Bystrov\AbstractShop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Bystrov\AbstractShop\Models\Product;
use Bystrov\AbstractShop\Models\Category;
use Bystrov\AbstractShop\Models\Supplier;
use Bystrov\AbstractShop\Models\Warehouse;

class ProductController extends Controller
{
    public function index()
    {
        return view('abstract-shop::products.index', [
            'items' => Product::query()->orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('abstract-shop::products.create', [
            'categories' => Category::query()->orderBy('name')->get(),
            'suppliers' => Supplier::query()->orderBy('name')->get(),
            'warehouses' => Warehouse::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:255', 'unique:abstract_shop_products,sku'],
            'price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'category_id' => ['nullable', 'integer'],
            'supplier_id' => ['nullable', 'integer'],
            'warehouse_id' => ['nullable', 'integer'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);
        Product::query()->create($data);
        return redirect()->route('abstract-shop.products.index');
    }

    public function show(Product $product)
    {
        return view('abstract-shop::products.show', ['item' => $product]);
    }

    public function edit(Product $product)
    {
        return view('abstract-shop::products.edit', [
            'item' => $product,
            'categories' => Category::query()->orderBy('name')->get(),
            'suppliers' => Supplier::query()->orderBy('name')->get(),
            'warehouses' => Warehouse::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:255', 'unique:abstract_shop_products,sku,' . $product->id],
            'price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'category_id' => ['nullable', 'integer'],
            'supplier_id' => ['nullable', 'integer'],
            'warehouse_id' => ['nullable', 'integer'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);
        $product->update($data);
        return redirect()->route('abstract-shop.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('abstract-shop.products.index');
    }
}

