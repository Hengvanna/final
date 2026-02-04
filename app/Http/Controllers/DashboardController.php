<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sale;
use App\Models\Stock;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(): View
    {
        $totalStocks = Stock::count();
        $totalCategories = Category::count();
        $totalSales = Sale::count();
        $totalRevenue = Sale::sum('total');

        return view('dashboard', [
            'title' => __('Dashboard'),
            'isDashboard' => true,
            'totalStocks' => $totalStocks,
            'totalCategories' => $totalCategories,
            'totalSales' => $totalSales,
            'totalRevenue' => $totalRevenue,
        ]);
    }
}
