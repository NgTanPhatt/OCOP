<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CustomerCategoryController extends Controller
{
    public function index(Request $request, $id)
    {
        $query = Product::with(['category', 'branch'])
            ->where('category_id', $id);

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

        $category = Category::findOrFail($id);

        return view('customer.category.index', compact('products', 'categories', 'category'));
    }
}
