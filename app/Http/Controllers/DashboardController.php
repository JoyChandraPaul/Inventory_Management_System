<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $lowStockThreshold = 5;

        $totalProducts = Product::count();
        $totalCustomers = Customer::count();
        $totalSales = Sale::count();
        $totalRevenue = (float) Sale::sum('grand_total');
        $lowStockCount = Product::where('stock_qty', '<=', $lowStockThreshold)->count();

        return view('admin.dashboard', compact(
            'lowStockThreshold',
            'totalProducts',
            'totalCustomers',
            'totalSales',
            'totalRevenue',
            'lowStockCount',
        ));
    }
}
