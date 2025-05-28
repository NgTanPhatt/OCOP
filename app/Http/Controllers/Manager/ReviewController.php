<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $reviews = Review::with(['product', 'user'])
            ->when($search, function ($query, $search) {
                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when(Auth::user()->role === 'manager', function ($query) {
                // Lấy branch_id của manager
                $branchId = Branch::where('user_id', Auth::id())->value('id');

                // Lọc theo sản phẩm thuộc branch của manager
                $query->whereHas('product', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->latest()
            ->paginate(10);

        return view('manager.reviews.index', compact('reviews', 'search'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Đã xóa đánh giá thành công.');
    }
}
