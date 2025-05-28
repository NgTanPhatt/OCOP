<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ItemOrder;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerOrderController extends Controller
{
    public function create(){
        if(!auth()->user()){
            return redirect()->route('customer.login.index')->with('error', 'Vui lòng đăng nhập');
        }

        $cart = session('cart', []);

        if($cart == null || count($cart) <= 0){
            return redirect()->route('customer.carts.index')->with('error', 'Không có sản phẩm trong giỏ hàng');
        } 
        return view('customer.order.create');
    }

    public function store(Request $request)
    {   
        if(!auth()->user()){
            return redirect()->route('customer.login.index')->with('error', 'Vui lòng đăng nhập');
        }

        $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
            'province_name' => 'required|string',
            'district_name' => 'required|string',
            'ward_name' => 'required|string',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống.');
        }

        $user = auth()->user();
        $discountCode = session('applied_discount_code');
        $discount = null;

        if ($discountCode) {
            $discount = Discount::where('code', $discountCode)
                ->whereDate('expiration_date', '>=', Carbon::today())
                ->first();
        }

        $ordersByBranch = [];

        // Gom sản phẩm theo branch
        foreach ($cart as $productId => $item) {
            $branchId = $item['branch_id'];
            $ordersByBranch[$branchId][] = [
                'product_id' => $productId,
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ];
        }

        DB::beginTransaction();

        try {
            foreach ($ordersByBranch as $branchId => $items) {
                $order = Order::create([
                    'user_id'     => $user->id,
                    'phone'       => $request->phone,
                    'address'     => $request->address . ', ' . $request->ward_name . ', ' . $request->district_name . ', ' . $request->province_name,
                    'branch_id'   => $branchId,
                    'discount_id' => ($discount && $discount->branch_id == $branchId) ? $discount->id : null,
                    'payment'     => 'COD', // hoặc thêm chọn thanh toán sau
                    'status'      => 'pending',
                    'amount'      => 0,
                ]);

                foreach ($items as $item) {
                    ItemOrder::create([
                        'order_id'   => $order->id,
                        'product_id' => $item['product_id'],
                        'quantity'   => $item['quantity'],
                    ]);

                    // Cập nhật tồn kho và số lượng đã bán
                    $product = Product::find($item['product_id']);
                    if ($product) {
                        $product->stock -= $item['quantity'];
                        $product->number_of_purchases += $item['quantity'];
                        $product->save();
                    }
                }

                $orderItems = ItemOrder::where('order_id', $order->id)->get();

                $amount = 0;

                foreach ($orderItems as $orderItem) {
                    $amount += $orderItem->product->price * $orderItem->quantity;
                }

                if($discount && $discount->branch_id == $branchId){
                    $amount -= $amount * $discount->percent / 100;
                }

                $order->amount = $amount;
                $order->save();
            }



            // Xóa session
            session()->forget('cart');
            session()->forget('applied_discount_code');
            session()->forget('discount_value');
            session()->forget('discount_percent');
            session()->forget('discount_branch');

            DB::commit();
            return redirect()->route('customer.users.index')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đặt hàng thất bại: ' . $e->getMessage());
        }
    }
}
