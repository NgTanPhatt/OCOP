<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;

class CustomerBranchController extends Controller
{
    public function index(Request $request)
    {
        $query = Branch::with(['user', 'products', 'news']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orWhere('address', 'like', "%$search%");
            });
        }

        $branches = $query->latest()->paginate(16);
        return view('customer.branch.index', compact('branches'));
    }

    public function show(Request $request, $id)
    {
        $branch = Branch::with(['user', 'products', 'news'])->findOrFail($id);
        $categories = Category::all();

        $products = Product::with(['category', 'branch'])
            ->where('branch_id', $id)
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->filled('price_from'), function ($query) use ($request) {
                $query->where('price', '>=', $request->price_from);
            })
            ->when($request->filled('price_to'), function ($query) use ($request) {
                $query->where('price', '<=', $request->price_to);
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereIn('category_id', $request->category);
            })
            ->latest()
            ->paginate(10)
            ->appends($request->query()); // để giữ lại các query khi phân trang

        $branchId = $branch->id;
        $countStar = Product::where('branch_id', $branch->id)->where('star', '!=', 0)->avg('star');
        $reviewCount = Review::whereHas('product', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->count();

        return view('customer.branch.show', compact('branch', 'products', 'categories', 'countStar','reviewCount'));
    }
}
