<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\User;
use App\Models\Review;
use App\Models\News;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index(){
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        if(auth()->user()->role == 'manager'){
            $currentBranch = auth()->user()->branch->id;

            $stats = [
                'products' => [
                    'total' => Product::where('branch_id', $currentBranch)->count(),
                    'new' => Product::where('branch_id', $currentBranch)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
                ],
                'discounts' => [
                    'total' => Discount::where('branch_id', $currentBranch)->count(),
                    'new' => Discount::where('branch_id', $currentBranch)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
                ],
                'users' => [
                    'total' => User::where('role', 'customer')
                        ->whereHas('orders', function ($query) use ($currentBranch) {
                            $query->where('branch_id', $currentBranch);
                        })->count(),

                    'new' => User::where('role', 'customer')
                        ->whereMonth('created_at', $currentMonth)
                        ->whereYear('created_at', $currentYear)
                        ->whereHas('orders', function ($query) use ($currentBranch) {
                            $query->where('branch_id', $currentBranch);
                        })->count(),
                ],
                'reviews' => [
                    'total' => Review::whereHas('product', function ($query) use ($currentBranch) {
                        $query->where('branch_id', $currentBranch);
                    })->count(),
                    'new' => Review::whereHas('product', function ($query) use ($currentBranch) {
                        $query->where('branch_id', $currentBranch);
                    })->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count(),
                ],
                'revenue' => [
                    'total' => Order::where('branch_id', $currentBranch) ->whereMonth('created_at', $currentMonth) ->whereYear('created_at', $currentYear) ->where('status', 'completed') ->sum('amount'),
                ],
                'orders' => [
                    'total' => Order::where('branch_id', $currentBranch)->count(),
                    'new' => Order::where('branch_id', $currentBranch)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
                ],
            ];

            $months = range(1, 12);

            $userCounts = [];
            $orderCounts = [];
            $reviewCounts = [];
            $revenueCounts = [];

            foreach ($months as $month) {
                // Users theo tháng và chi nhánh (qua orders)
                $userCounts[] = User::where('role', 'customer')
                    ->whereMonth('created_at', $month)
                    ->whereHas('orders', function ($query) use ($currentBranch) {
                        $query->where('branch_id', $currentBranch);
                    })->count();

                // Orders theo tháng và chi nhánh
                $orderCounts[] = Order::where('branch_id', $currentBranch)
                    ->whereMonth('created_at', $month)
                    ->count();

                // Reviews theo tháng và chi nhánh (qua products)
                $reviewCounts[] = Review::whereMonth('created_at', $month)
                    ->whereHas('product', function ($query) use ($currentBranch) {
                        $query->where('branch_id', $currentBranch);
                    })->count();
                
                $revenueCounts[] = Order::where('branch_id', $currentBranch)
                    ->whereMonth('created_at', $month)
                    ->where('status', 'completed') // Chỉ tính đơn có trạng thái doanh thu
                    ->sum('amount');
            }

            $latestOrders = Order::where('branch_id', $currentBranch)->latest()->take(5)->get();

            return view('manager.dashboard.index', compact('stats', 'months', 'userCounts', 'orderCounts', 'reviewCounts', 'revenueCounts', 'latestOrders'));
        }

        $stats = [
            'branches' => [
                'total' => Branch::count(),
                'new' => Branch::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
            ],
            'products' => [
                'total' => Product::count(),
                'new' => Product::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
            ],
            'categories' => [
                'total' => Category::count(),
                'new' => Category::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
            ],
            'discounts' => [
                'total' => Discount::count(),
                'new' => Discount::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
            ],
            'users' => [
                'total' => User::count(),
                'new' => User::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
            ],
            'reviews' => [
                'total' => Review::count(),
                'new' => Review::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
            ],
            'news' => [
                'total' => News::count(),
                'new' => News::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
            ],
            'orders' => [
                'total' => Order::count(),
                'new' => Order::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count(),
            ],
        ];

        $months = range(1, 12);

        $storeCounts = [];
        $orderCounts = [];
        $productCounts = [];

        foreach ($months as $month) {
            $storeCounts[] = Branch::whereMonth('created_at', $month)->count();
            $orderCounts[] = Order::whereMonth('created_at', $month)->count();
            $productCounts[] = Product::whereMonth('created_at', $month)->count();
        }

        //Lấy 6 cửa hàng mới nhất
        $latestStores = Branch::orderBy('created_at', 'desc')->limit(6)->get();

        return view('manager.dashboard.index', compact('stats', 'months', 'storeCounts', 'orderCounts', 'productCounts', 'latestStores'));
    }
}
