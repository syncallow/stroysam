<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::tree();
        return view('admin.categories.index', compact('categories'));
    }

    public function create() {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        $newCategory = Category::create($data);
        if (!$newCategory) return redirect()->back()->with('error', 'Ошибка при создании категории.');
        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно создана');
    }

    public function edit(Category $category) {
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('categories', 'category'));
    }

    public function update(UpdateRequest $request, Category $category) {
        $data = $request->validated();
        $res = $category->update($data);
        if (!$res) return redirect()->back()->with('error', 'Ошибка при редактировании категории.');
        return redirect()->back()->with('success', 'Категория отредатирована успешно');
    }

    public function delete(Category $category) {
        $res = $category->delete();
        if (!$res) return redirect()->back()->with('error', 'Ошибка при удалении категории');
        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно удалена');
    }
}
