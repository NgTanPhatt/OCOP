<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');

        $query = User::query()->with(['branch', 'orders']);

        if (Auth::user()->role === 'manager') {
            $branchId = Branch::where('user_id', Auth::id())->value('id');

            $query->whereHas('orders', function ($q) use ($branchId) {
                $q->where('branch_id', $branchId);
            })->where('role', 'customer');
        } else {
            $query->when($role, function ($q, $role) {
                $q->where('role', $role);
            });
        }

        $query->when($search, function ($q, $search) {
            $q->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                    ->orWhere('fullname', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        });

        $users = $query->orderByRaw("FIELD(role, 'admin', 'manager', 'customer')")
                    ->paginate(10);

        return view('manager.users.index', compact('users'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('manager.users.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $rules = [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,manager',
            'branch_id' => 'nullable|exists:branches,id', // branch_id là nullable, chỉ kiểm tra khi là manager
            'password' => 'required|string|min:6|confirmed',
        ];

        $messages = [
            'fullname.required' => 'Vui lòng nhập họ tên.',
            'fullname.string' => 'Họ tên không hợp lệ.',
            'fullname.max' => 'Họ tên không được vượt quá 255 ký tự.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',

            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.string' => 'Tên đăng nhập không hợp lệ.',
            'username.max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',

            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',

            'role.required' => 'Vui lòng chọn vai trò.',
            'role.in' => 'Vai trò không hợp lệ.',

            'branch_id.exists' => 'Chi nhánh không hợp lệ.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo người dùng
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Nếu là manager, tạo chi nhánh và gán cho người dùng
        if ($request->role === 'manager' && $request->filled('branch_id')) {
            $branch = Branch::find($request->branch_id);
            $branch->user_id = $user->id; // Gán người dùng làm quản lý chi nhánh
            $branch->save();
        }

        return redirect()->route('manager.users.index')->with('success', 'Tạo người dùng thành công.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $branches = Branch::all();
        return view('manager.users.edit', compact('user', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,manager',
            'branch_id' => 'nullable|exists:branches,id',  // Chỉ bắt buộc nếu là manager
            'password' => 'nullable|string|min:6|confirmed',
        ];

        $messages = [
            'fullname.required' => 'Vui lòng nhập họ tên.',
            'fullname.string' => 'Họ tên không hợp lệ.',
            'fullname.max' => 'Họ tên không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.string' => 'Tên đăng nhập không hợp lệ.',
            'username.max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'role.required' => 'Vui lòng chọn vai trò.',
            'role.in' => 'Vai trò không hợp lệ.',
            'branch_id.exists' => 'Chi nhánh không hợp lệ.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cập nhật thông tin người dùng
        $user->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        // Cập nhật chi nhánh nếu người dùng là manager
        if ($request->role === 'manager' && $request->filled('branch_id')) {
            // Cập nhật chi nhánh của người dùng trong bảng branches
            $branch = Branch::findOrFail($request->branch_id);
            $branch->user_id = $user->id;
            $branch->save();
        } elseif ($request->role !== 'manager') {
            // Nếu không phải manager thì gỡ liên kết chi nhánh
            $branch = Branch::where('user_id', $user->id)->first();
            if ($branch) {
                $branch->user_id = null;
                $branch->save();
            }
        }

        // Cập nhật mật khẩu nếu có
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('manager.users.index')->with('success', 'Cập nhật người dùng thành công.');
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manager.users.index')->with('success', 'Xóa người dùng thành công.');
    }
}
