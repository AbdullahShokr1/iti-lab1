<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $q = $request->query('q');

        $query = Category::withCount('products')->orderBy('created_at', 'desc');

        if ($q) {
            $query->where('name', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%");
        }

        $categories = $query->paginate(12)->withQueryString();
        $trashedCount = Category::onlyTrashed()->count();

        return view('categories.index', compact('categories', 'q','trashedCount'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $data['image'] = $path;
        }

        $category = Category::create($data);

        return redirect()->route('categories.show', $category)->with('success', 'Category created.');
    }

    public function show(Category $category)
    {
        $category->load(['products' => function ($q) {
            $q->latest()->paginate(12);
        }]);

        $products = $category->products()->latest()->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('categories.show', $category)->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }

    public function trashed()
    {
        $trashedCategories = Category::onlyTrashed()->paginate(20);
        return view('categories.trashed', compact('trashedCategories'));
    }

    public function restore($id)
    {

        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $category);
        $category->restore();

        return redirect()->route('categories.trashed')->with('success', 'تم استرجاع القسم بنجاح.');
    }

    public function forceDelete($id)
    {

        $category = Category::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $category);

        if ($category->image && Storage::disk('public')->exists("categories/{$category->image}")) {
            Storage::disk('public')->delete("categories/{$category->image}");
        }

        $category->forceDelete();

        return redirect()->route('categories.trashed')->with('success', 'تم حذف القسم نهائيًا.');
    }
}
