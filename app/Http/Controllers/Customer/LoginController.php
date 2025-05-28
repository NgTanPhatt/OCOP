<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('customer.users.index');
        }
        return view('customer.login.index');
    }

    public function submit(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('customer.users.index');
        }

        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ], [
            'login.required' => 'Vui lòng nhập email, số điện thoại hoặc tên đăng nhập.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $loginInput = $request->input('login');
        $password = $request->input('password');

        $loginTypes = ['email', 'username', 'phone'];
        foreach ($loginTypes as $field) {
            $credentials = [$field => $loginInput, 'password' => $password];

            if (auth()->attempt($credentials)) {
                $user = auth()->user();
                if ($user->role === 'customer') {
                    return redirect()->route('customer.home.index')->with('success', 'Đăng nhập thành công!');
                } else {
                    auth()->logout(); // Đăng xuất nếu không phải customer
                    return redirect()->back()->withErrors(['login' => 'Bạn không có quyền truy cập.'])->withInput();
                }
            }
        }

        return redirect()->back()->withErrors(['login' => 'Thông tin đăng nhập không chính xác.'])->withInput();
    }

    public function register()
    {
        if (auth()->check()) {
            return redirect()->route('customer.users.index');
        }

        return view('customer.register.index');
    }

    public function registerSubmit(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('customer.users.index');
        }
        
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:11|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'fullname.required' => 'Họ tên không được bỏ trống.',
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Email không hợp lệ.',
            'phone.required' => 'Số điện thoại không được bỏ trống.',
            'password.required' => 'Mật khẩu không được bỏ trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu không khợp lệ.',
            'username.required' => 'Tên người dùng không được bỏ trống.',
            'username.unique' => 'Tên người dùng đã tồn tại.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
        ]);

        $user = new \App\Models\User();
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
        $user->role = 'customer';
        $user->username = $request->input('username');
        $user->save();

        //Đăng nhập người dùng luôn
        auth()->login($user);

        return redirect()->route('customer.home.index');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('customer.login.index');
    }
}
