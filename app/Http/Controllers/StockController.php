<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StockController extends Controller
{
    /**
     * Display a listing of stocks.
     */
    public function index(Request $request): View
    {
        $filterBy = $request->get('filter_by', 'name');
        $query = Stock::query()->with('categories')->where('qty', '>', 0);

        if ($filterBy === 'category') {
            $categoryId = $request->get('category_id');
            if ($categoryId) {
                $query->whereHas('categories', fn ($q) => $q->where('categories.id', $categoryId));
            }
        } else {
            $search = $request->get('search');
            if ($search) {
                if ($filterBy === 'brand') {
                    $query->where('brand', 'like', "%{$search}%");
                } else {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('code_tire', 'like', "%{$search}%");
                    });
                }
            }
        }

        $stocks = $query->orderBy('id')->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('stocks.index', [
            'stocks' => $stocks,
            'categories' => $categories,
            'filterBy' => $filterBy,
        ]);
    }

    /**
     * Show the form for creating a new stock.
     */
    public function create(): View
    {
        $names = Category::query()->distinct()->pluck('name', 'name');
        return view('stocks.create', [
            'names' => $names,
        ]);
    }

    /**
     * Store a newly created stock.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code_tire' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        Stock::create($validated);

        return redirect()->route('stocks.index')
            ->with('success', __('Stock created successfully.'));
    }

    /**
     * Display the specified stock (redirect to edit).
     */
    public function show(Stock $stock): RedirectResponse
    {
        return redirect()->route('stocks.edit', $stock);
    }

    /**
     * Show the form for editing the specified stock.
     */
    public function edit(Stock $stock): View
    {
        return view('stocks.edit', ['stock' => $stock]);
    }

    /**
     * Update the specified stock.
     */
    public function update(Request $request, Stock $stock): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:255'],
            'code_tire' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        $stock->update($validated);

        return redirect()->route('stocks.index')
            ->with('success', __('Stock updated successfully.'));
    }

    /**
     * Remove the specified stock.
     */
    public function destroy(Stock $stock): RedirectResponse
    {
        $stock->delete();
        return redirect()->route('stocks.index')
            ->with('success', __('Stock deleted successfully.'));
    }
}
