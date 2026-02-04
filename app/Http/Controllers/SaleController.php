<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SaleController extends Controller
{
    /**
     * Display a listing of sales (CRED Sales).
     */
    public function index(Request $request): View
    {
        $query = Sale::query()->with('stock');
        $search = $request->get('search');
        $stockId = $request->get('stock_id');

        if ($request->filled('search')) {
            $query->whereHas('stock', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code_tire', 'like', "%{$search}%");
            });
        }

        if ($request->filled('stock_id')) {
            $query->where('stock_id', $stockId);
        }

        $sales = $query->orderByDesc('sale_date')->orderByDesc('id')->paginate(10)->withQueryString();
        $stocks = Stock::orderBy('name')->get();

        return view('sales.index', [
            'title' => __('CRED Sales'),
            'sales' => $sales,
            'stocks' => $stocks,
            'maps' => [
                __('Dashboard') => route('dashboard'),
                __('CRED Sales') => '#',
            ],
        ]);
    }

    /**
     * Show the form for creating a new sale.
     */
    public function create(): View
    {
        $stocks = Stock::orderBy('name')->get();

        return view('sales.create', [
            'title' => __('Add Sale'),
            'sale' => new Sale(['sale_date' => now(), 'qty' => 1, 'price' => 0, 'total' => 0]),
            'stocks' => $stocks,
            'maps' => [
                __('Dashboard') => route('dashboard'),
                __('CRED Sales') => route('sales.index'),
                __('Add') => '#',
            ],
        ]);
    }

    /**
     * Store a newly created sale.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'stock_id' => ['required', 'exists:stocks,id'],
            'qty' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer', 'min:0'],
            'total_price' => ['required', 'integer', 'min:0'],
        ]);
        $validated['total'] = $validated['total_price'];
        $validated['sale_date'] = now();

        Sale::create($validated);

        return redirect()->route('sales.index')
            ->with('success', __('Sale created successfully.'));
    }

    /**
     * Show the form for editing the specified sale.
     */
    public function edit(Sale $sale): View
    {
        $sale->load('stock');
        $stocks = Stock::orderBy('name')->get();

        return view('sales.edit', [
            'title' => __('Edit Sale'),
            'sale' => $sale,
            'stocks' => $stocks,
            'maps' => [
                __('Dashboard') => route('dashboard'),
                __('CRED Sales') => route('sales.index'),
                __('Edit') => '#',
            ],
        ]);
    }

    /**
     * Update the specified sale.
     */
    public function update(Request $request, Sale $sale): RedirectResponse
    {
        $validated = $request->validate([
            'stock_id' => ['required', 'exists:stocks,id'],
            'qty' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer', 'min:0'],
            'total_price' => ['required', 'integer', 'min:0'],
        ]);
        $validated['total'] = $validated['total_price'];

        $sale->update($validated);

        return redirect()->route('sales.index')
            ->with('success', __('Sale updated successfully.'));
    }

    /**
     * Remove the specified sale.
     */
    public function destroy(Sale $sale): RedirectResponse
    {
        $sale->delete();

        return redirect()->route('sales.index')
            ->with('success', __('Sale deleted successfully.'));
    }
}
