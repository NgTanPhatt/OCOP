<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerUserController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('customer.login.index');
        }

        // Lấy danh sách đơn hàng người dùng
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(5);
        return view('customer.user.index', compact('orders'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Nếu người dùng muốn đổi mật khẩu, validate xác nhận mật khẩu
        $rules = [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:11|unique:users,phone,' . $user->id,
            'current_password' => 'nullable',
        ];

        if ($request->filled('new_password')) {
            $rules['new_password'] = 'required|string|min:6|confirmed';
        }

        $request->validate($rules, [
            'fullname.required' => 'Họ tên không được bỏ trống.',
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'phone.required' => 'Số điện thoại không được bỏ trống.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'new_password.required' => 'Mật khẩu mới không được bỏ trống.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        // Cập nhật thông tin
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Cập nhật mật khẩu nếu có yêu cầu
        if ($request->filled('new_password')) {
            if (!\Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
            }
            $user->password = bcrypt($request->input('new_password'));
        }

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }

    public function orderShow($id){
        $order = Order::findOrFail($id);
        return view('customer.user.order', compact('order'));
    }
}
