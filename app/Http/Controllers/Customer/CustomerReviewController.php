<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerReviewController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Bạn phải đăng nhập để đánh giá sản phẩm.');
        }

        // Gán mặc định nếu thiếu
        $star = $request->input('star', 5);
        $product_id = $request->input('product_id');
        $content = $request->input('content');

        // Validate từng lỗi và trả về ngay
        if (!is_numeric($star) || (int)$star < 1 || (int)$star > 5) {
            return redirect()->back()->with('error', 'Vui lòng chọn số sao.');
        }

        if (!$product_id) {
            return redirect()->back()->with('error', 'Thiếu mã sản phẩm.');
        }

        if (!\App\Models\Product::where('id', $product_id)->exists()) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        if (!$content) {
            return redirect()->back()->with('error', 'Vui lòng nhập nội dung đánh giá.');
        }

        if (strlen($content) > 150) {
            return redirect()->back()->with('error', 'Nội dung đánh giá không vượt quá 150 ký tự.');
        }

        $user = auth()->user();

        // Kiểm tra đã mua sản phẩm chưa
        $hasPurchased = \App\Models\Order::where('user_id', $user->id)
            ->whereHas('items', function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            })
            ->exists();

        if (!$hasPurchased) {
            return redirect()->back()->with('error', 'Bạn chỉ có thể đánh giá sản phẩm đã mua.');
        }

        // Lưu hoặc cập nhật đánh giá
        $review = \App\Models\Review::where('user_id', $user->id)
            ->where('product_id', $product_id)
            ->first();

        if ($review) {
            $review->update([
                'star' => $star,
                'content' => $content,
            ]);
        } else {
            \App\Models\Review::create([
                'star' => $star,
                'content' => $content,
                'product_id' => $product_id,
                'user_id' => $user->id,
            ]);
        }

        // Cập nhật sao trung bình
        $avgStar = \App\Models\Review::where('product_id', $product_id)->avg('star');
        \App\Models\Product::where('id', $product_id)->update(['star' => round($avgStar, 1)]);

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được ghi nhận.');
    }

}
