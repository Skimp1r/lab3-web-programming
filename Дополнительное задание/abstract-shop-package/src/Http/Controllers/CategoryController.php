<?php

namespace Bystrov\AbstractShop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Bystrov\AbstractShop\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('abstract-shop::categories.index', [
            'items' => Category::query()->orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('abstract-shop::categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer'],
        ]);
        Category::query()->create($data);
        return redirect()->route('abstract-shop.categories.index');
    }

    public function show(Category $category)
    {
        return view('abstract-shop::categories.show', ['item' => $category]);
    }

    public function edit(Category $category)
    {
        return view('abstract-shop::categories.edit', ['item' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer'],
        ]);
        $category->update($data);
        return redirect()->route('abstract-shop.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('abstract-shop.categories.index');
    }
}

