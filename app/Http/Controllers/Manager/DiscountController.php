<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        $query = Discount::with('branch');

        // Nếu là manager, chỉ lấy khuyến mãi thuộc chi nhánh của họ
        if (Auth::user()->role === 'manager') {
            $branchId = Branch::where('user_id', Auth::id())->value('id');
            $query->where('branch_id', $branchId);
        }

        // Tìm kiếm theo mã giảm giá
        if ($request->has('search') && $request->search) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }

        $discounts = $query->latest()->paginate(10);

        return view('manager.discounts.index', compact('discounts'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->role == 'manager') {
            $branches = Branch::where('user_id', $user->id)->get();
        } else {
            $branches = Branch::all();
        }

        return view('manager.discounts.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'code' => 'required|string|max:50|unique:discounts,code',
            'percent' => 'required|numeric|min:0|max:100',
            'expiration_date' => 'required|date|after:today',
        ];

        if ($user->role == 'manager') {
            $branchId = Branch::where('user_id', $user->id)->value('id');
            $request->merge(['branch_id' => $branchId]);
        } else {
            $rules['branch_id'] = 'required|exists:branches,id';
        }

        $validator = Validator::make($request->all(), $rules, [
            'branch_id.required' => 'Vui lòng chọn cửa hàng.',
            'branch_id.exists' => 'Cửa hàng không hợp lệ.',
            'code.required' => 'Vui lòng nhập mã giảm giá.',
            'code.string' => 'Mã giảm giá không hợp lệ.',
            'code.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'code.unique' => 'Mã giảm giá đã tồn tại.',
            'percent.required' => 'Vui lòng nhập phần trăm giảm.',
            'percent.numeric' => 'Phần trăm giảm phải là số.',
            'percent.min' => 'Phần trăm giảm phải từ 0%.',
            'percent.max' => 'Phần trăm giảm không vượt quá 100%.',
            'expiration_date.required' => 'Vui lòng chọn ngày hết hạn.',
            'expiration_date.date' => 'Ngày hết hạn không hợp lệ.',
            'expiration_date.after' => 'Ngày hết hạn phải sau hôm nay.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($user->role == 'manager') {
            $data['branch_id'] = Branch::where('user_id', $user->id)->value('id');
        }

        Discount::create($data);

        return redirect()->route('manager.discounts.index')->with('success', 'Tạo mã giảm giá thành công.');
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $user = Auth::user();

        if ($user->role == 'manager') {
            $branches = Branch::where('user_id', $user->id)->get();
        } else {
            $branches = Branch::all();
        }

        return view('manager.discounts.edit', compact('discount', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);
        $user = Auth::user();

        $rules = [
            'code' => 'required|string|max:50|unique:discounts,code,' . $discount->id,
            'percent' => 'required|numeric|min:0|max:100',
            'expiration_date' => 'required|date|after:today',
        ];

        if ($user->role == 'manager') {
            $branchId = Branch::where('user_id', $user->id)->value('id');
            $request->merge(['branch_id' => $branchId]);
        } else {
            $rules['branch_id'] = 'required|exists:branches,id';
        }

        $validator = Validator::make($request->all(), $rules, [
            'branch_id.required' => 'Vui lòng chọn cửa hàng.',
            'branch_id.exists' => 'Cửa hàng không hợp lệ.',
            'code.required' => 'Vui lòng nhập mã giảm giá.',
            'code.string' => 'Mã giảm giá không hợp lệ.',
            'code.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'code.unique' => 'Mã giảm giá đã tồn tại.',
            'percent.required' => 'Vui lòng nhập phần trăm giảm.',
            'percent.numeric' => 'Phần trăm giảm phải là số.',
            'percent.min' => 'Phần trăm giảm phải từ 0%.',
            'percent.max' => 'Phần trăm giảm không vượt quá 100%.',
            'expiration_date.required' => 'Vui lòng chọn ngày hết hạn.',
            'expiration_date.date' => 'Ngày hết hạn không hợp lệ.',
            'expiration_date.after' => 'Ngày hết hạn phải sau hôm nay.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $discount->update($validator->validated());

        return redirect()->route('manager.discounts.edit', $id)->with('success', 'Cập nhật mã giảm giá thành công.');
    }

    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->route('manager.discounts.index')->with('success', 'Xóa mã giảm giá thành công.');
    }
}
