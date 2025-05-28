<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class ConfigController extends Controller
{
    public function index()
    {
        $branch = null;
        if (Auth::user()->role === 'manager') {
            $branch = Branch::where('user_id', Auth::id())->first();
        }

        return view('manager.config.index', compact('branch'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'avatar.image' => 'Tệp tải lên phải là hình ảnh.',
            'avatar.mimes' => 'Chỉ chấp nhận các định dạng: jpg, jpeg, png, gif.',
            'avatar.max' => 'Ảnh đại diện không được vượt quá 2MB.',
        ]);

        $branch = Branch::where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('branches', 'public');
            $branch->avatar = $path;
        }

        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        $branch->save();

        return redirect()->route('manager.config.index')->with('success', 'Cập nhật cấu hình chi nhánh thành công.');
    }
}
