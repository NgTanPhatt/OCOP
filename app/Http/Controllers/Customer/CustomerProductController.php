<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\ViewHistory;
use Illuminate\Support\Facades\Http;

class CustomerProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'branch']);
    
        // Tìm theo tên sản phẩm
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        // Lọc theo giá
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
    
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }
    
        // Lọc theo tỉnh thành từ address (LIKE)
        if ($request->has('province') && is_array($request->province)) {
            $query->whereHas('branch', function ($q) use ($request) {
                $q->where(function ($subQ) use ($request) {
                    foreach ($request->province as $province) {
                        $subQ->orWhere('address', 'like', "%$province%");
                    }
                });
            });
        }
    
        // Sắp xếp
        if ($request->sort == 'new') {
            $query->latest('created_at');
        } elseif ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        }
    
        $products = $query->paginate(20);
    
        $categories = Category::with(['products' => function ($q) {
            $q->latest()->take(10);
        }])->withCount('products')->get();
    
        return view('customer.product.index', compact('products', 'categories'));
    }    

    public function show($id)
    {
        $product = Product::with(['category', 'branch', 'reviews'])->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(8)
            ->get();
        $countProduct = Product::where('branch_id', $product->branch_id)->count();
        $countStar = Product::where('branch_id', $product->branch_id)->where('star', '!=', 0)->avg('star');
        $countNumberOfPurchases = Product::where('branch_id', $product->branch_id)->sum('number_of_purchases');
        // Lấy tỷ lệ % theo từ 1 đến 5 sao của sản phẩm
        $totalReviews = $product->reviews->count();

        $starPercentages = [];
        $averageStar = 0;

        if ($totalReviews > 0) {
            for ($i = 1; $i <= 5; $i++) {
                $count = $product->reviews->where('star', $i)->count();
                $starPercentages[$i] = round(($count / $totalReviews) * 100, 1);
                $averageStar += $i * $count;
            }
            $averageStar = round($averageStar / $totalReviews, 1);
        } else {
            for ($i = 1; $i <= 5; $i++) {
                $starPercentages[$i] = 0;
            }
        }

        $reviews = Review::with('user')
            ->where('product_id', $product->id)
            ->latest()
            ->get();
        

        $branchId = $product->branch_id;
        // Lấy số lượng đánh giá sản phẩm thuộc cửa hàng
        $reviewCountBranch = Review::whereHas('product', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->count();

        
        $recommendations = [];

        if (auth()->check()) {
            try {
                $response = Http::timeout(5)->get('http://127.0.0.1:5000/recommend', [
                    'user_id' => auth()->id()
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['error'])) {
                        $recommendations = [];
                    } else {
                        $recommendations = $data;
                    }
                }
            } catch (\Exception $e) {
                // Ghi log nếu cần: Log::error('Recommendation API error: ' . $e->getMessage());
                $recommendations = []; // Giữ giá trị an toàn
            }
        }

        // Tạo lượt xem trong bảng view_histories
        $viewHistory = new ViewHistory();

        if (auth()->check()) {
            $viewHistory->user = auth()->id();
            $viewHistory->product_id = $product->id;
            $viewHistory->save();
        }

        return view('customer.product.show', compact('product', 'recommendations', 'relatedProducts', 'countProduct', 'countStar', 'countNumberOfPurchases', 'averageStar', 'totalReviews', 'starPercentages', 'reviews', 'reviewCountBranch'));
    }
}
