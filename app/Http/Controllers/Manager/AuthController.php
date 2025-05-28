<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function index(){
        if (Auth::check()) {
            return redirect()->route('manager.dashboard.index');
        }

        return view('manager.login.index');
    }

    public function submit(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('manager.dashboard.index');
        }

        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Vui lòng nhập tài khoản hoặc email.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        // Kiểm tra nếu có lỗi validate
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Kiểm tra xem có tài khoản hoặc email tồn tại không
        $user = User::where('email', $request->username)
                    ->orWhere('username', $request->username)
                    ->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Tài khoản hoặc email không tồn tại.'])->withInput();
        }

        // Kiểm tra mật khẩu
        if (!\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Mật khẩu không chính xác.'])->withInput();
        }

        // Đăng nhập thành công
        Auth::login($user);
        return redirect()->route('manager.dashboard.index');
    }

    public function logout()
    {
        Auth::logout(); // Đăng xuất người dùng

        request()->session()->invalidate(); // Hủy session hiện tại
        request()->session()->regenerateToken(); // Tạo lại CSRF token

        return redirect()->route('manager.login.index')->with('success', 'Đăng xuất thành công!');
    }
}
