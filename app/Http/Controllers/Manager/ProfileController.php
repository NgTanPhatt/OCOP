<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    // Hiển thị thông tin người dùng
    public function index()
    {
        $user = Auth::user();  // Lấy thông tin người dùng đã đăng nhập
        return view('manager.profile.index', compact('user'));  // Trả về view profile và truyền thông tin người dùng
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request)
    {
        $user = Auth::user();  // Lấy thông tin người dùng đã đăng nhập

        // Validate dữ liệu nhập vào
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Kiểm tra email đã tồn tại chưa, ngoại trừ người dùng hiện tại
            'phone' => 'required|string|max:11',
            'password' => 'nullable|string|min:6|confirmed', // Xác nhận mật khẩu nếu có
            'current_password' => 'nullable|required_with:password|current_password',  // Mật khẩu cũ phải có khi thay đổi mật khẩu
            'role' => 'in:admin,manager,customer',  // Không cho phép người dùng tự đổi role
        ], [
            'fullname.required' => 'Họ tên không được bỏ trống.',
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Email không hợp lệ.',
            'phone.required' => 'Số điện thoại không được bỏ trống.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'current_password.required_with' => 'Bạn phải nhập mật khẩu cũ khi thay đổi mật khẩu.',
            'current_password.current_password' => 'Mật khẩu cũ không chính xác.',
            'role.in' => 'Role không hợp lệ.',
        ]);

        // Nếu người dùng thay đổi mật khẩu
        if ($request->filled('password')) {
            // Kiểm tra mật khẩu cũ
            if (!\Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu cũ không chính xác.']);
            }

            // Cập nhật mật khẩu mới
            $user->password = bcrypt($request->password);
        }

        // Cập nhật các trường còn lại
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Lưu thông tin vào cơ sở dữ liệu
        $user->save();

        // Quay lại trang profile với thông báo thành công
        return redirect()->route('manager.profile.index')->with('success', 'Cập nhật thông tin thành công!');
    }
}
