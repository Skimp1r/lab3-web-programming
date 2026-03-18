<?php

namespace Bystrov\AbstractShop\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Bystrov\AbstractShop\Models\Product;
use Bystrov\AbstractShop\Http\Resources\ProductResource;
use Bystrov\AbstractShop\Http\Resources\ProductCollection;
use Bystrov\AbstractShop\Http\Requests\StoreProductRequest;
use Bystrov\AbstractShop\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = max(1, min($perPage, 50));

        $q = Product::query()->orderBy('id', 'desc')->paginate($perPage);
        return new ProductCollection($q);
    }

    public function store(StoreProductRequest $request)
    {
        $p = Product::query()->create($request->validated());
        return (new ProductResource($p))->response()->setStatusCode(201);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['deleted' => true]);
    }
}

