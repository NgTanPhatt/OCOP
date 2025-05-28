<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Order;
use App\Models\ItemOrder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->orderByDesc('created_at');

        // Nếu user là manager, chỉ hiển thị đơn hàng thuộc chi nhánh của họ
        if (auth()->user()->role == 'manager') {
            $branchId = Branch::where('user_id', Auth::id())->value('id');
            $query->where('branch_id', $branchId);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('phone', 'like', "%$search%")
                ->orWhereHas('user', fn($q2) => $q2->where('fullname', 'like', "%$search%"));
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $orders = $query->paginate(10);

        return view('manager.orders.index', compact('orders'));
    }

    public function show($id)
    {
        if (auth()->user()->role == 'manager') {
            $branchId = Branch::where('user_id', Auth::id())->value('id');
            $order = Order::with(['user', 'items.product'])
                ->where('branch_id', $branchId) // Use $branchId instead of Auth::user()->branch_id
                ->findOrFail($id);
            return view('manager.orders.show', compact('order'));
        }else{
            $order = Order::with(['user', 'items.product'])
                ->findOrFail($id);
            return view('manager.orders.show', compact('order'));
        }
    }

    public function edit($id)
    {
        if (auth()->user()->role == 'manager') {
            $branchId = Branch::where('user_id', Auth::id())->value('id');
            $order = Order::with(['user', 'items.product'])
                ->where('branch_id', $branchId) // Use $branchId instead of Auth::user()->branch_id
                ->findOrFail($id);
            return view('manager.orders.edit', compact('order'));

        }else{
            $order = Order::with(['user', 'items.product'])
                ->findOrFail($id);
            return view('manager.orders.edit', compact('order'));

        }
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,shipping,delivered,completed,cancelled,refunded',
            'payment_status' => 'required|in:cod,bank', // Thêm validation cho trạng thái thanh toán
        ], [
            'status.required' => 'Vui lòng chọn trạng thái đơn hàng.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'payment_status.required' => 'Vui lòng chọn trạng thái thanh toán.',
            'payment_status.in' => 'Trạng thái thanh toán không hợp lệ.',
        ]);

        $branchId = Branch::where('user_id', Auth::id())->value('id');

        // Tìm đơn hàng của chi nhánh hiện tại
        $order = Order::where('branch_id', $branchId)->findOrFail($id);

        // Cập nhật trạng thái đơn hàng và trạng thái thanh toán
        $order->status = $request->status;
        $order->payment = $request->payment_status; // Cập nhật trạng thái thanh toán
        $order->save();

        // Quay lại trang danh sách đơn hàng và thông báo thành công
        return redirect()->route('manager.orders.show', $id)->with('success', 'Cập nhật trạng thái đơn hàng và thanh toán thành công!');
    }
}
