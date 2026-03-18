<?php

namespace Bystrov\AbstractShop\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Bystrov\AbstractShop\Models\Category;
use Bystrov\AbstractShop\Http\Resources\CategoryResource;
use Bystrov\AbstractShop\Http\Resources\CategoryCollection;
use Bystrov\AbstractShop\Http\Requests\StoreCategoryRequest;
use Bystrov\AbstractShop\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = max(1, min($perPage, 50));

        $q = Category::query()->orderBy('id', 'desc')->paginate($perPage);
        return new CategoryCollection($q);
    }

    public function store(StoreCategoryRequest $request)
    {
        $c = Category::query()->create($request->validated());
        return (new CategoryResource($c))->response()->setStatusCode(201);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['deleted' => true]);
    }
}

