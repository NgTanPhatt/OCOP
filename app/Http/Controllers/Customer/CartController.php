<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Carbon;

class CartController extends Controller
{
    public function index()
    {
        return view('customer.cart.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity;

        if($quantity > Product::find($productId)->stock){
            return redirect()->back()->with('error', 'Số lượng trong kho không đủ.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Nếu đã có sản phẩm thì cộng thêm số lượng
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Thêm mới sản phẩm
            $product = Product::findOrFail($productId);
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'avatar' => $product->avatar,
                'quantity' => $quantity,
                'branch_id' => $product->branch_id,
            ];
        }

        session()->put('cart', $cart);

        if($request->has('buy_now')){
            return redirect()->route('customer.orders.create');
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $product = Product::findOrFail($request->product_id);

            if ($request->quantity > $product->stock) {
                return response()->json([
                    'error' => 'Số lượng trong kho không đủ.',
                    'max_quantity' => $product->stock
                ], 422);
            }

            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            $subtotal = $cart[$request->product_id]['quantity'] * $cart[$request->product_id]['price'];
            $total = collect($cart)->reduce(fn($carry, $item) => $carry + $item['price'] * $item['quantity'], 0);

            return response()->json([
                'message' => 'Cập nhật thành công!',
                'subtotal' => number_format($subtotal, 0, ',', '.'),
                'total' => number_format($total, 0, ',', '.'),
            ]);
        }

        return response()->json(['error' => 'Sản phẩm không tồn tại trong giỏ hàng.'], 404);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);

            // Nếu có mã giảm giá đã áp dụng
            if (session()->has('applied_discount_code') && session()->has('discount_branch')) {
                $branchId = session('discount_branch');

                // Kiểm tra còn sản phẩm nào thuộc chi nhánh đó không
                $stillHasDiscountedProduct = false;
                foreach ($cart as $id => $item) {
                    $product = Product::find($id);
                    if ($product && $product->branch_id == $branchId) {
                        $stillHasDiscountedProduct = true;
                        break;
                    }
                }

                // Nếu không còn sản phẩm nào thuộc chi nhánh được giảm, xóa mã giảm
                if (!$stillHasDiscountedProduct) {
                    session()->forget([
                        'applied_discount_code',
                        'discount_value',
                        'discount_percent',
                        'discount_branch',
                    ]);
                }
            }

            $total = collect($cart)->reduce(fn($carry, $item) => $carry + $item['price'] * $item['quantity'], 0);

            return response()->json([
                'message' => 'Đã xóa sản phẩm!',
                'total' => number_format($total, 0, ',', '.'),
                'product_id' => $productId
            ]);
        }

        return response()->json(['error' => 'Sản phẩm không tồn tại.'], 404);
    }

    public function discount(Request $request)
    {
        $request->validate([
            'discount' => 'required|string'
        ]);

        $code = $request->discount;
        $discount = Discount::where('code', $code)
            ->whereDate('expiration_date', '>=', Carbon::today())
            ->first();

        if (!$discount) {
            return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
        }

        $cart = session()->get('cart', []);

        if (session()->has('applied_discount_code')) {
            return redirect()->back()->with('error', 'Bạn đã áp dụng mã giảm giá.');
        }

        $branchId = $discount->branch_id;
        $percent = $discount->percent;
        $totalDiscount = 0;

        foreach ($cart as $productId => &$item) {
            $product = Product::find($productId);

            if ($product && $product->branch_id == $branchId) {
                $item['original_price'] = $item['price'];
                $discountAmount = ($item['price'] * $item['quantity'] * $percent) / 100;
                $item['price'] = round($item['price'] * $item['quantity'] - $discountAmount);
                $totalDiscount += $discountAmount;
            }
        }


        // ✅ Cập nhật thêm thông tin giảm giá
        session()->put('cart', $cart);
        session()->put('applied_discount_code', $code);
        session()->put('discount_value', $totalDiscount);
        session()->put('discount_percent', $percent); // <--- thêm dòng này
        session()->put('discount_branch', $branchId); // <--- và dòng này

        return redirect()->route('customer.orders.create')->with('success', 'Áp dụng mã giảm giá thành công!');
    }
}
