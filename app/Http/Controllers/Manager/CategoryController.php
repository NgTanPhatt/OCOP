<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Support\Facades\Storage; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Tìm kiếm theo tên chuyên mục
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lấy số lượng sản phẩm trong từng chuyên mục
        $categories = $query->withCount('products')->paginate(10);

        return view('Manager.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('manager.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ], [
            'name.required' => 'Vui lòng nhập tên chuyên mục.',
            'avatar.image' => 'Ảnh đại diện phải là tệp hình ảnh.',
        ]);

        $category = new Category($validated);

        // Nếu có ảnh, tiến hành lưu
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('categories', 'public');
            $category->avatar = $avatarPath;
        }

        $category->save();

        return redirect()->route('manager.categories.index')->with('success', 'Tạo chuyên mục thành công.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id); // Tìm chuyên mục theo ID
        return view('manager.categories.edit', compact('category'));
    }

    // Cập nhật chuyên mục
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10048', // Kiểm tra ảnh
        ], [
            'name.required' => 'Vui lòng nhập tên chuyên mục.',
            'avatar.image' => 'Vui lòng chọn ảnh hợp lệ.',
            'avatar.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png hoặc gif.',
            'avatar.max' => 'Ảnh không được vượt quá 10MB.',
        ]);

        $category = Category::findOrFail($id); // Tìm chuyên mục theo ID

        // Cập nhật thông tin
        $category->name = $request->name;

        // Nếu có ảnh mới, upload ảnh và cập nhật
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('categories', 'public');
            $category->avatar = $avatarPath;
        }

        $category->save();

        return redirect()->route('manager.categories.edit', $id)->with('success', 'Danh mục đã được cập nhật.');
    }

    public function destroy($id)
    {
        // Tìm chuyên mục theo ID
        $category = Category::findOrFail($id);

        // Xóa ảnh đại diện nếu có
        if ($category->avatar) {
            Storage::disk('public')->delete($category->avatar);
        }

        // Xóa chuyên mục
        $category->delete();

        // Trả về thông báo thành công
        return redirect()->route('manager.categories.index')->with('success', 'Chuyên mục đã được xóa thành công.');
    }
}
