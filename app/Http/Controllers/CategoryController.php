<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(Request $request): View
    {
        $query = Category::query()
            ->from('categories')
            ->leftJoin(DB::raw('(SELECT c2.name AS cat_name, COALESCE(SUM(s.qty), 0) AS total_qty FROM categories c2 INNER JOIN stocks s ON s.id = c2.stock_id GROUP BY c2.name) AS name_totals'), 'name_totals.cat_name', '=', 'categories.name')
            ->select('categories.*', DB::raw('COALESCE(name_totals.total_qty, 0) AS stock_qty_count'));

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('year', 'like', "%{$search}%");
            });
        }

        $categories = $query->with('stock')->latest('categories.id')->paginate(10)->withQueryString();

        return view('categories.index', [
            'title' => __('Categories'),
            'categories' => $categories,
            'maps' => [
                __('Dashboard') => route('dashboard'),
                __('Categories') => '#',
            ],
        ]);
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('categories.create', [
            'title' => __('Add Category'),
            'category' => new Category(),
            'maps' => [
                __('Dashboard') => route('dashboard'),
                __('Categories') => route('categories.index'),
                __('Add') => '#',
            ],
        ]);
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'count' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:2048'],
        ]);

        $validated['count'] = $validated['count'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', __('Category created successfully.'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', [
            'title' => __('Edit Category'),
            'category' => $category,
            'maps' => [
                __('Dashboard') => route('dashboard'),
                __('Categories') => route('categories.index'),
                __('Edit') => '#',
            ],
        ]);
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'count' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        $validated['count'] = $validated['count'] ?? 0;

        if ($request->boolean('remove_image') && $category->image) {
            Storage::disk('public')->delete($category->image);
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', __('Category updated successfully.'));
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', __('Category deleted successfully.'));
    }
}
