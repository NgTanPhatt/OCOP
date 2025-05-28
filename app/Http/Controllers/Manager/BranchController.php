<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $query = Branch::query();

        // Tìm kiếm theo tên chi nhánh
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Phân trang và lấy dữ liệu
        $branches = $query->paginate(10); // Hoặc thay đổi số lượng phân trang theo yêu cầu

        return view('Manager.branches.index', compact('branches'));
    }

    public function create()
    {
        $users = User::where('role', 'manager')->get(); // Hoặc filter theo role nếu cần
        return view('manager.branches.create', compact('users'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:branches,email',
            'user_id' => 'required|exists:users,id',
        ], [
            'name.required' => 'Vui lòng nhập tên cửa hàng.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'user_id.required' => 'Vui lòng chọn người quản lý.',
            'user_id.exists' => 'Người quản lý không hợp lệ.',
        ]);
    
        Branch::create($validated);
    
        return redirect()->route('manager.branches.index')->with('success', 'Tạo cửa hàng thành công.');
    }


    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        $users = User::where('role', 'manager')->get(); // hoặc có thể giới hạn theo role, etc.
        return view('manager.branches.edit', compact('branch', 'users'));
    }


    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Tên cửa hàng là bắt buộc.',
            'address.required' => 'Địa chỉ là bắt buộc.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^0[0-9]{9}$/'],
            'email' => 'required|email|max:255',
        ], $messages);

        $branch = Branch::findOrFail($id);
        $branch->update($validated);

        return redirect()->route('manager.branches.edit', $id)->with('success', 'Cập nhật cửa hàng thành công.');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);

        $branch->delete();

        return redirect()->route('manager.branches.index')->with('success', 'Xóa cửa hàng thành công.');
    }
}
