<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display the CRED report (stock and sales summary).
     */
    public function index(Request $request): View
    {
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $stockCount = Stock::count();
        $stockTotalQty = Stock::sum('qty');
        $stockValue = Stock::selectRaw('SUM(qty * price) as value')->value('value') ?? 0;

        $salesQuery = Sale::query();
        if ($dateFrom) {
            $salesQuery->whereDate('sale_date', '>=', $dateFrom);
        }
        if ($dateTo) {
            $salesQuery->whereDate('sale_date', '<=', $dateTo);
        }

        $saleCount = (clone $salesQuery)->count();
        $saleTotalRevenue = (clone $salesQuery)->sum('total');
        $saleTotalQty = (clone $salesQuery)->sum('qty');

        $recentSales = Sale::with('stock')
            ->when($dateFrom, fn ($q) => $q->whereDate('sale_date', '>=', $dateFrom))
            ->when($dateTo, fn ($q) => $q->whereDate('sale_date', '<=', $dateTo))
            ->orderByDesc('sale_date')
            ->limit(10)
            ->get();

        return view('reports.index', [
            'title' => __('CRED Report'),
            'stockCount' => $stockCount,
            'stockTotalQty' => $stockTotalQty,
            'stockValue' => $stockValue,
            'saleCount' => $saleCount,
            'saleTotalRevenue' => $saleTotalRevenue,
            'saleTotalQty' => $saleTotalQty,
            'recentSales' => $recentSales,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'maps' => [
                __('Dashboard') => route('dashboard'),
                __('CRED Report') => '#',
            ],
        ]);
    }

    /**
     * Display the Report Sale page (sales-focused report).
     */
    public function sale(Request $request): View
    {
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $salesQuery = Sale::with('stock');
        if ($dateFrom) {
            $salesQuery->whereDate('sale_date', '>=', $dateFrom);
        }
        if ($dateTo) {
            $salesQuery->whereDate('sale_date', '<=', $dateTo);
        }

        $saleCount = (clone $salesQuery)->count();
        $saleTotalRevenue = (clone $salesQuery)->sum('total');
        $saleTotalQty = (clone $salesQuery)->sum('qty');
        $sales = (clone $salesQuery)->orderByDesc('sale_date')->paginate(15)->withQueryString();

        return view('reports.sale', [
            'title' => __('Report Sale'),
            'sales' => $sales,
            'saleCount' => $saleCount,
            'saleTotalRevenue' => $saleTotalRevenue,
            'saleTotalQty' => $saleTotalQty,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'maps' => [
                __('Dashboard') => route('dashboard'),
                __('CRED Report') => route('reports.index'),
                __('Report Sale') => '#',
            ],
        ]);
    }

    /**
     * Display the Report Stock page (stock-focused report).
     */
    public function stock(Request $request): View
    {
        $stockCount = Stock::count();
        $stockTotalQty = Stock::sum('qty');
        $stockValue = Stock::selectRaw('SUM(qty * price) as value')->value('value') ?? 0;
        $stocks = Stock::orderBy('name')->paginate(15)->withQueryString();

        return view('reports.stock', [
            'title' => __('Report Stock'),
            'stocks' => $stocks,
            'stockCount' => $stockCount,
            'stockTotalQty' => $stockTotalQty,
            'stockValue' => $stockValue,
            'maps' => [
                __('Dashboard') => route('dashboard'),
                __('CRED Report') => route('reports.index'),
                __('Report Stock') => '#',
            ],
        ]);
    }
}
